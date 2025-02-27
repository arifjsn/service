<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
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
            ->whereNull('sender')
            ->paginate(10);

        return view('admin.transactions.index', [
            'transactions' => $transactions
        ]);
    }
}
