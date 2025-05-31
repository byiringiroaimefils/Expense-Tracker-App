<?php

namespace App\Http\Controllers;

use App\Models\register;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class transactionController extends Controller
{
    public function index(Request $request)
    {
        $user = register::find(Session::get('loginId'));
        $isAdmin = $user->role === 'admin';

        // Base query with user relationship
        $query = $isAdmin
            ? transaction::with('register')
            : transaction::where('register_id', $user->id);

        // Apply filters
        if ($request->has('user_id') && $isAdmin) {
            $query->where('register_id', $request->user_id);
        }

        if ($request->has('type') && in_array($request->type, ['income', 'expense'])) {
            $query->where('type', $request->type);
        }
        // Get paginated results
        $transactions = $query->paginate(10)->withQueryString();

        // Calculate totals based on current filters
        $totalQuery = $isAdmin
            ? transaction::query()
            : transaction::where('register_id', $user->id);

        // Apply the same filters to totals
        if ($request->has('user_id') && $isAdmin) {
            $totalQuery->where('register_id', $request->user_id);
        }
        if ($request->has('type') && in_array($request->type, ['income', 'expense'])) {
            $totalQuery->where('type', $request->type);
        }
        if ($request->has('start_date')) {
            $totalQuery->whereDate('transaction_date', '>=', $request->start_date);
        }
        if ($request->has('end_date')) {
            $totalQuery->whereDate('transaction_date', '<=', $request->end_date);
        }

        $totalIncome = (clone $totalQuery)->where('type', 'income')->sum('amount');
        $totalExpense = (clone $totalQuery)->where('type', 'expense')->sum('amount');
        $profit = $totalIncome - $totalExpense;

        // Get all users for admin filter
        $users = $isAdmin ? register::all() : [];

        return view('Transaction.transaction', compact(
            'transactions',
            'isAdmin',
            'totalIncome',
            'totalExpense',
            'profit',
            'users',
            'request'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'amount' => 'required',
            'category' => 'required',
            'transaction_date' => 'required',
        ]);
        $Add_transaction = transaction::create([
            'register_id' => Session::get('loginId'),
            'type' => $request->type,
            'amount' => $request->amount,
            'category' => $request->category,
            'transaction_date' => $request->transaction_date,
        ]);
        return redirect()->route('transaction')->with('message', 'Transaction successful added');
    }

    public function edit($id)
    {
        $edit_transaction = transaction::findOrFail($id);
        return view('Transaction.update_form', compact('edit_transaction'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'amount' => 'required',
            'category' => 'required',
            'transaction_date' => 'required',
        ]);
        $Add_transaction = transaction::findOrFail($id)->update([
            'register_id' => Session::get('loginId'),
            'type' => $request->type,
            'amount' => $request->amount,
            'category' => $request->category,
            'transaction_date' => $request->transaction_date,
        ]);
        return redirect()->route('transaction')->with('message', 'Transaction successful Updated');
    }

    public function delete($id)
    {
        $delete_transaction = transaction::findOrFail($id)->delete();
        return back()->with('message', 'Transaction successful Deleted');
    }
}
