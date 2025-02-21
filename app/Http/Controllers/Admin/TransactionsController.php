<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transanctions;
use App\Models\Logs;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TransactionsController extends Controller
{
    public function index(Request $request): View
    {
        $transactions = Transactions::latest()
            ->when($request->pencarian, function ($query, $pencarian) {
            return $query->whereLike(['invoice', 'item_name', 'item_user', 'serial_number', 'status'], $pencarian);
            })
            ->when($request->tgl_awal, function ($query, $tglAwal) {
            return $query->where('input_date', '>=', $tglAwal);
            })
            ->when($request->tgl_akhir, function ($query, $tglAkhir) {
            return $query->where('input_date', '<=', $tglAkhir);
            })
            ->when($request->status, function ($query, $status) {
            return $query->whereLike('status', "%{$status}%");
            })
            ->when($request->brand, function ($query, $brand) {
            return $query->whereLike('brand', "%{$brand}%");
            })
            ->whereNull('sender')
            ->paginate(10);

        return view('admin.transactions.index', [
            'transactions' => $transactions
        ]);
    }

    public function detail($id): View
    {
        $claimGaransi = ClaimGaransi::find($id);

        return view('admin.claim-garansi.detail', [
            'claimGaransi' => $claimGaransi
        ]);
    }

    public function tolak($id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $claimGaransi = ClaimGaransi::find($id);
            if (!$claimGaransi) {
                return redirect()->back()->with('error', 'Data tidak ditemukan');
            }

            if ($claimGaransi->status === 'APPROVED') {
                return redirect()->back()->with('error', 'Tidak bisa proses data karena sudah diterima');
            }

            Logs::create([
                'user_id' => Auth::user()->id,
                'deskripsi' => Auth::user()->email . ' menolak claim garansi dengan nomor garansi: ' . $claimGaransi->nomor_garansi
            ]);

            $claimGaransi->status = 'REJECTED';
            $claimGaransi->save();

            $mailSubject = $claimGaransi->brand !== 'ESR' ? ucfirst(strtolower($claimGaransi->brand)) : $claimGaransi->brand . ' Claim Garansi [Rejected]';
            $userData = [
                'nama' => $claimGaransi->nama,
                'nomor_garansi' => $claimGaransi->nomor_garansi,
                'brand' => $claimGaransi->brand,
            ];
            Mail::to($claimGaransi->email)->send(new RejectClaimGaransiMailer($mailSubject, $userData));

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil memproses data garansi');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function terima($id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $claimGaransi = ClaimGaransi::find($id);
            if (!$claimGaransi) {
                return redirect()->back()->with('error', 'Data tidak ditemukan');
            }

            if ($claimGaransi->status === 'REJECTED') {
                return redirect()->back()->with('error', 'Tidak bisa proses data karena sudah ditolak');
            }

            Logs::create([
                'user_id' => Auth::user()->id,
                'deskripsi' => Auth::user()->email . ' menolak claim garansi dengan nomor garansi: ' . $claimGaransi->nomor_garansi
            ]);

            $claimGaransi->status = 'APPROVED';
            $claimGaransi->save();

            $mailSubject = $claimGaransi->brand !== 'ESR' ? ucfirst(strtolower($claimGaransi->brand)) : $claimGaransi->brand . ' Claim Garansi [Approved]';
            $userData = [
                'nama' => $claimGaransi->nama,
                'nomor_garansi' => $claimGaransi->nomor_garansi,
                'brand' => $claimGaransi->brand,
            ];
            Mail::to($claimGaransi->email)->send(new ApproveClaimGaransiMailer($mailSubject, $userData));

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil memproses data garansi');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function progress(Request $request, $id): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $claimGaransi = ClaimGaransi::find($id);
            if (!$claimGaransi) {
                return redirect()->back()->with('error', 'Data tidak ditemukan');
            }

            Logs::create([
                'user_id' => Auth::user()->id,
                'deskripsi' => Auth::user()->email . ' mengubah proses claim garansi menjadi ' . $request->progress . ' dengan nomor garansi: ' . $claimGaransi->nomor_garansi
            ]);

            $claimGaransi->progress = $request->progress;
            $claimGaransi->save();

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil memperbaharui proses claim garansi');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
