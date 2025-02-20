<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrasiGaransiRequest;
use App\Models\RegistrasiGaransi;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegistrasiGaransiController extends Controller
{

    public function index()
    {
        return view('registrasi-garansi.index');
    }

    public function form()
    {
        $user = Auth::user();
        $noGaransi = date('Ym') . registrasiGaransi::get()->count();

        return view('registrasi-garansi.form', [
            'user' => $user,
            'noGaransi' => $noGaransi
        ]);
    }

    /**
     * Registrasi Garansi Action
     */
    public function store(RegistrasiGaransiRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $struk = $request->struk_pembelian;
            $filename = time() . '_' . Str::random(16) . '.' . $struk->getClientOriginalExtension();
            $struk->move(storage_path('app/public/garansi/struk_pembelian'), $filename);
            $pathStruk = "storage/garansi/struk_pembelian/$filename";

            RegistrasiGaransi::create([
                'user_id' => Auth::user()->id,
                'nama' => $request->nama,
                'nomor_hp' => $request->nomor_hp,
                'email' => $request->email,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'provinsi' => $request->provinsi,
                'kota' => $request->kota,
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'rt_rw' => $request->rt_rw,
                'kode_pos' => $request->kode_pos,
                'brand' => $request->brand,
                'struk_pembelian' => $pathStruk,
                'no_invoice' => $request->no_invoice,
                'model_barang' => $request->model_barang,
                'jenis_barang' => $request->jenis_barang,
                'nomor_garansi' => date('Ym') . registrasiGaransi::get()->count(),
                'tanggal_pembelian' => $request->tanggal_pembelian,
                'metode_pembelian' => $request->metode_pembelian,
                'nama_toko' => $request->nama_toko,
                'keterangan_tambahan' => $request->keterangan_tambahan,
                'qr_code' => $request->qr_code,
            ]);

            DB::commit();

            return redirect()->route('dashboard')->with('success', 'Registrasi Garansi Berhasil');
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Terjadi Kesalahan');
        }
    }

    public function forms(Request $request): View
    {
        $forms = RegistrasiGaransi::latest()
            ->whereLike('user_id', Auth::user()->id)
            ->when($request->tgl_awal || $request->tgl_akhir, function ($query) use ($request) {
                if ($request->tgl_awal && $request->tgl_akhir) $query->whereBetween('tanggal_pembelian', [$request->tgl_awal, $request->tgl_akhir]);
                else if ($request->tgl_awal) $query->whereDate('tanggal_pembelian', '>=', $request->tgl_awal);
                else if ($request->akhir) $query->whereDate('tanggal_pembelian', '<=', $request->tgl_awal);
            })
            ->when($request->pencarian, function ($query, $pencarian) {
                return $query->whereLike(['nama', 'nomor_hp', 'nomor_garansi', 'model_barang', 'jenis_barang', 'tanggal_pembelian', 'status'], $pencarian);
            })
            ->orderBy('id', 'ASC')
            ->paginate(10);

        return view('registrasi-garansi.forms', [
            'forms' => $forms
        ]);
    }

    public function detail($id): View
    {
        $registrasiGaransi = RegistrasiGaransi::find($id);

        return view('registrasi-garansi.detail', [
            'registrasiGaransi' => $registrasiGaransi
        ]);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $form = RegistrasiGaransi::find($id);

            $form->delete();

            DB::commit();

            return redirect()->back()->with('success', "Berhasil menghapus data");
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
