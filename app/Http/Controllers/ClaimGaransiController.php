<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClaimGaransiRequest;
use App\Models\ClaimGaransi;
use App\Models\RegistrasiGaransi;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClaimGaransiController extends Controller
{
    public function index()
    {
        return view('claim-garansi.index');
    }

    public function form()
    {
        $user = Auth::user();

        $registrasiGaransi = RegistrasiGaransi::query()
            ->whereLike('user_id', $user->id)
            ->whereLike('status', 'APPROVED')
            ->get();

        return view('claim-garansi.form', [
            'user' => $user,
            'registrasiGaransi' => $registrasiGaransi
        ]);
    }

    /**
     * Claim Garansi Action
     */
    public function store(ClaimGaransiRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $fotoTipeBarang = $request->foto_tipe_barang;
            $filename = time() . '_' . Str::random(16) . '.' . $fotoTipeBarang->getClientOriginalExtension();
            $fotoTipeBarang->move(storage_path('app/public/garansi/foto_tipe_barang'), $filename);
            $pathFotoTipeBarang = "storage/garansi/foto_tipe_barang/$filename";

            $fotoStiker = $request->foto_stiker;
            $filename = time() . '_' . Str::random(16) . '.' . $fotoStiker->getClientOriginalExtension();
            $fotoStiker->move(storage_path('app/public/garansi/foto_stiker'), $filename);
            $pathFotoStiker = "storage/garansi/foto_stiker/$filename";

            $fotoKerusakan = $request->foto_kerusakan;
            $filename = time() . '_' . Str::random(16) . '.' . $fotoKerusakan->getClientOriginalExtension();
            $fotoKerusakan->move(storage_path('app/public/garansi/foto_kerusakan'), $filename);
            $pathFotoKerusakan = "storage/garansi/foto_kerusakan/$filename";

            $strukPembelian = $request->foto_struk_pembelian;
            $filename = time() . '_' . Str::random(16) . '.' . $strukPembelian->getClientOriginalExtension();
            $strukPembelian->move(storage_path('app/public/garansi/foto_struk_pembelian'), $filename);
            $pathFotoStrukPembelian = "storage/garansi/foto_struk_pembelian/$filename";

            ClaimGaransi::create([
                'user_id' => Auth::user()->id,
                'nomor_garansi' => $request->nomor_garansi,
                'nama' => $request->nama,
                'nomor_hp' => $request->nomor_hp,
                'email' => $request->email,
                'alamat_penerima' => $request->alamat_penerima,
                'foto_tipe_barang' => $pathFotoTipeBarang,
                'foto_stiker' => $pathFotoStiker,
                'alasan_kerusakan' => $request->alasan_kerusakan,
                'foto_kerusakan' => $pathFotoKerusakan,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rt_rw' => $request->rt_rw,
                'kode_pos' => $request->kode_pos,
                'brand' => $request->brand,
                'foto_struk_pembelian' => $pathFotoStrukPembelian,
                'no_invoice' => $request->no_invoice,
                'model_barang' => $request->model_barang,
                'jenis_barang' => $request->jenis_barang,
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'metode_pembelian' => $request->metode_pembelian,
                'nama_toko' => $request->nama_toko,
                'keterangan_tambahan' => $request->keterangan_tambahan,
                'qr_code' => $request->qr_code
            ]);

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Berhasil');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan');
        }
    }

    public function forms(Request $request): View
    {
        $forms = ClaimGaransi::latest()
            ->whereLike('user_id', Auth::user()->id)
            ->when($request->tgl_awal || $request->tgl_akhir, function ($query) use ($request) {
                if ($request->tgl_awal && $request->tgl_akhir) $query->whereBetween('tanggal_pembelian', [$request->tgl_awal, $request->tgl_akhir]);
                else if ($request->tgl_awal) $query->whereDate('tanggal_pembelian', '>=', $request->tgl_awal);
                else if ($request->akhir) $query->whereDate('tanggal_pembelian', '<=', $request->tgl_awal);
            })
            ->when($request->pencarian, function ($query, $pencarian) {
                return $query->whereLike(['nama', 'nomor_hp', 'nomor_garansi', 'email', 'model_barang', 'jenis_barang', 'tanggal_pembelian', 'status'], "%{$pencarian}%");
            })
            ->orderBy('id', 'ASC')
            ->paginate(10);

        return view('claim-garansi.forms', [
            'forms' => $forms
        ]);
    }

    public function detail($id): View
    {
        $claimGaransi = ClaimGaransi::find($id);

        return view('claim-garansi.detail', [
            'claimGaransi' => $claimGaransi
        ]);
    }
}
