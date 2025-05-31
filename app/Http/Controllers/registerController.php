<?php

namespace App\Http\Controllers;

use App\Models\register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class registerController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'email|unique:register',
            'password' => 'required|min:6',
        ]);
        $user = register::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/login')->back()->with('message', 'User succeessful register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email',
            'password' => 'required|min:6',
        ]);
        $user = register::where('email', '=', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('loginId', $user->id);
                return redirect('dashboard');
            } else {
                return back()->with('message', 'Invalid User Name and Password');
            }
        } else {
            return back()->with('message', 'Invalid email');
        }
    }

    public function dashboard()
    {
        $data = null;
        $user = register::where('id', Session::get('loginId'))->first();
        if ($user->role == 'accountant') {
            $data = register::where('id', Session::get('loginId'))->first();
            $transactions = \App\Models\transaction::where('register_id', Session::get('loginId'))->get();

            // Calculate financial summary
            $totalIncome = $transactions->where('type', 'income')->sum('amount');
            $totalExpense = $transactions->where('type', 'expense')->sum('amount');
            $currentBalance = $totalIncome - $totalExpense;
            $profit = $currentBalance;
        } else {
            $data = register::where('id', Session::get('loginId'))->first();
            $transactions = \App\Models\transaction::All();
            $totalIncome = $transactions->where('type', 'income')->sum('amount');
            $totalExpense = $transactions->where('type', 'expense')->sum('amount');
            $currentBalance = $totalIncome - $totalExpense;
            $profit = $currentBalance;
        }

        return view('dashboard', compact('data', 'totalIncome', 'totalExpense', 'currentBalance', 'profit'));
        return redirect()->route('login');
    }

    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
        }
        return redirect('/login')->with('message', 'Logged out successfully');
    }
}
