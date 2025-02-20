<?php

namespace App\Http\Controllers\Admin;

use App\Mail\ApproveRegistrasiGaransiMailer;
use App\Mail\RejectRegistrasiGaransiMailer;
use App\Http\Controllers\Controller;
use App\Models\RegistrasiGaransi;
use App\Models\Logs;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegistrasiGaransiController extends Controller
{
    public function index(Request $request): View
    {
        $registrasiGaransi = RegistrasiGaransi::latest()
            ->when($request->pencarian, function ($query, $pencarian) {
                return $query->whereLike(['nama', 'nomor_hp', 'nomor_garansi', 'model_barang', 'jenis_barang', 'tanggal_pembelian', 'status'], $pencarian);
            })
            ->when($request->tgl_awal, function ($query, $tglAwal) {
                return $query->where('tanggal_pembelian', '>=', $tglAwal);
            })
            ->when($request->tgl_akhir, function ($query, $tglAkhir) {
                return $query->where('tanggal_pembelian', '<=', $tglAkhir);
            })
            ->when($request->status, function ($query, $status) {
                return $query->whereLike('status', "%{$status}%");
            })
            ->when($request->brand, function ($query, $brand) {
                return $query->whereLike('brand', "%{$brand}%");
            })
            ->paginate(10);

        return view('admin.registrasi-garansi.index', [
            'registrasiGaransi' => $registrasiGaransi
        ]);
    }

    public function detail($id): View
    {
        $registrasiGaransi = RegistrasiGaransi::find($id);

        return view('admin.registrasi-garansi.detail', [
            'registrasiGaransi' => $registrasiGaransi
        ]);
    }

    public function tolak($id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $registrasiGaransi = RegistrasiGaransi::find($id);
            if (!$registrasiGaransi) {
                return redirect()->back()->with('error', 'Data tidak ditemukan');
            }

            if ($registrasiGaransi->status === 'APPROVED') {
                return redirect()->back()->with('error', 'Tidak bisa proses data karena sudah diterima');
            }

            Logs::create([
                'user_id' => Auth::user()->id,
                'deskripsi' => Auth::user()->email . ' menolak registrasi garansi dengan nomor garansi: ' . $registrasiGaransi->nomor_garansi
            ]);

            $registrasiGaransi->status = 'REJECTED';
            $registrasiGaransi->save();

            $mailSubject = $registrasiGaransi->brand !== 'ESR' ? ucfirst(strtolower($registrasiGaransi->brand)) : $registrasiGaransi->brand . ' Registrasi Garansi [Rejected]';
            $userData = [
                'nama' => $registrasiGaransi->nama,
                'nomor_garansi' => $registrasiGaransi->nomor_garansi,
                'brand' => $registrasiGaransi->brand,
            ];
            Mail::to($registrasiGaransi->email)->send(new RejectRegistrasiGaransiMailer($mailSubject, $userData));

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menolak Registrasi Garansi');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function terima($id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $registrasiGaransi = RegistrasiGaransi::find($id);
            if (!$registrasiGaransi) {
                return redirect()->back()->with('error', 'Data tidak ditemukan');
            }

            if ($registrasiGaransi->status === 'REJECTED') {
                return redirect()->back()->with('error', 'Tidak bisa proses data karena sudah ditolak');
            }

            Logs::create([
                'user_id' => Auth::user()->id,
                'deskripsi' => Auth::user()->email . ' menolak registrasi garansi dengan nomor garansi: ' . $registrasiGaransi->nomor_garansi
            ]);

            $tanggal_pembelian = $registrasiGaransi->tanggal_pembelian;
            $selisih_hari = date_diff(date_create(date('Y-m-d', strtotime($registrasiGaransi->created_at))), date_create($tanggal_pembelian));
            if ($registrasiGaransi->brand === 'WINKEY') {
                if ($selisih_hari->days >= 30) {
                    $expired = date('Y-m-d', strtotime('+18 month', strtotime($tanggal_pembelian))); // 18 bulan
                } else {
                    $expired = date('Y-m-d', strtotime('+2 year', strtotime($tanggal_pembelian))); // 2 tahun
                }
            }
            if ($registrasiGaransi->brand === 'ESR' && $registrasiGaransi->isElectrical === 1) {
                $expired = date('Y-m-d', strtotime('+1 year', strtotime($tanggal_pembelian))); // 1 tahun
            }
            if ($registrasiGaransi->brand === 'ESR' && $registrasiGaransi->isElectrical !== 1) {
                $expired = date('Y-m-d', strtotime('+1 month', strtotime($tanggal_pembelian))); // 1 bulan
            }
            if ($registrasiGaransi->brand === 'JISULIFE') {
                $expired = date('Y-m-d', strtotime('+1 year', strtotime($tanggal_pembelian))); // 1 tahun
            }
            if ($registrasiGaransi->brand === 'QUINCY') {
                $expired = date('Y-m-d', strtotime('+1 year', strtotime($tanggal_pembelian))); // 1 tahun
            }

            $registrasiGaransi->status = 'APPROVED';
            $registrasiGaransi->expired = $expired;
            $registrasiGaransi->save();

            $mailSubject = $registrasiGaransi->brand !== 'ESR' ? ucfirst(strtolower($registrasiGaransi->brand)) : $registrasiGaransi->brand . ' Registrasi Garansi [Approved]';
            $userData = [
                'nama' => $registrasiGaransi->nama,
                'nomor_garansi' => $registrasiGaransi->nomor_garansi,
                'brand' => $registrasiGaransi->brand,
            ];
            Mail::to($registrasiGaransi->email)->send(new ApproveRegistrasiGaransiMailer($mailSubject, $userData));

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil menyetujui Registrasi Garansi');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function electrical(Request $request, $id): RedirectResponse
    {
        try {
            $registrasiGaransi = RegistrasiGaransi::find($id);
            if (!$registrasiGaransi) {
                return redirect()->back()->with('error', 'Data tidak ditemukan');
            }

            $registrasiGaransi->isElectrical = $request->electrical;
            $registrasiGaransi->save();

            return redirect()->back()->with('success', 'Berhasil memperbaharui data');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
