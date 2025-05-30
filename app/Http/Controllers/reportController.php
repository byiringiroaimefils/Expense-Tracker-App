<?php

namespace App\Http\Controllers;
use App\Models\transaction;
use App\Models\register;
use Illuminate\Support\Facades\Session;


use Illuminate\Http\Request;

class reportController extends Controller
{
    public function index(Request $request)
    {
        $user = register::find(Session::get('loginId'));
        $user_role = $user->role === 'admin';
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        if ($start && $end) {

            if ($user->role === 'admin') {
                $transactions = Transaction::whereBetween('transaction_date', [$start, $end]);
            } else {
                $transactions = Transaction::where('register_id', Session::get('loginId'))->whereBetween('transaction_date', [$start, $end])->get();
            }

        } else {

            if ($user->role === 'admin') {
                $transactions = transaction::all();
            } else {
                $transactions = transaction::where('register_id', Session::get('loginId'))->get();
            }
        }


        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $profit = $totalIncome - $totalExpense;

        return view('report', compact('transactions', 'user_role', 'start', 'end', 'totalIncome', 'totalExpense', 'profit'));
    }

}
