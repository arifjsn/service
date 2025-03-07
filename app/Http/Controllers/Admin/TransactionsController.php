<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use App\Models\Logs;
use App\Models\User;
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
            ->when($request->search, function ($query, $search) {
                return $query->whereLike(['invoice', 'item_name', 'item_user', 'serial_number', 'status'], $search);
            })
            ->when($request->start_date, function ($query, $start_date) {
                return $query->where('input_date', '>=', $start_date);
            })
            ->when($request->end_date, function ($query, $end_date) {
                return $query->where('output_date', '<=', $end_date);
            })
            ->when($request->status, function ($query, $status) {
                return $query->whereLike('status', "%{$status}%");
            })
            ->when($request->user, function ($query, $user) {
                return $query->whereLike('user_id', "%{$user}%");
            })
            ->whereNull('sender')
            ->paginate(10);

        $users = User::all();

        return view('admin.transactions.index', [
            'transactions' => $transactions,
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice' => 'required',
            'input_date' => 'required|date',
            'item_name' => 'required',
            'serial_number' => 'required',
            'complaint' => 'required',
            'information' => 'required',
            'status' => 'required',
        ]);

        Transactions::create($request->all());

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'invoice' => 'required',
            'input_date' => 'required|date',
            'item_name' => 'required',
            'serial_number' => 'required',
            'complaint' => 'required',
            'information' => 'required',
            'status' => 'required',
        ]);

        $transaction = Transactions::findOrFail($id);
        $transaction->update($request->all());

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy($id)
    {
        $transaction = Transactions::findOrFail($id);
        $transaction->delete();

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
