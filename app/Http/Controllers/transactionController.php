<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\transaction;
use App\Models\register;
class transactionController extends Controller
{
    public function index()
    {
        $user = register::find(Session::get('loginId'));
        $user_role = $user->role === 'admin';
        if ($user_role) {
            $transactions = transaction::all()->orderBy('transaction_date');
            // $transactions = transaction::with('register')->first();
        } else {
            $transactions = transaction::where('register_id', Session::get('loginId'))->get();
        }
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $profit = $totalIncome - $totalExpense;

        return view('transaction', compact('transactions', 'user_role', 'totalIncome', 'totalExpense', 'profit'));
    }



    public function store(Request $request)
    {
        $request->validate([
            "type" => "required",
            "amount" => "required",
            "category" => "required",
            "transaction_date" => "required",
        ]);
        $Add_transaction = transaction::create([
            "register_id" => Session::get('loginId'),
            "type" => $request->type,
            "amount" => $request->amount,
            "category" => $request->category,
            "transaction_date" => $request->transaction_date,
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
            "type" => "required",
            "amount" => "required",
            "category" => "required",
            "transaction_date" => "required",
        ]);
        $Add_transaction = transaction::findOrFail($id)->update([
            "register_id" => Session::get('loginId'),
            "type" => $request->type,
            "amount" => $request->amount,
            "category" => $request->category,
            "transaction_date" => $request->transaction_date,
        ]);
        return redirect()->route('transaction')->with('message', 'Transaction successful Updated');
    }
    public function delete($id)
    {
        $delete_transaction = transaction::findOrFail($id)->delete();
        return back()->with('message', 'Transaction successful Deleted');
    }
}
