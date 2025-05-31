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
        $isAdmin = $user->role === 'admin';
        $start = $request->input('start_date');
        $end = $request->input('end_date');
        
        // Base query
        $query = $isAdmin 
            ? Transaction::with('register')
            : Transaction::where('register_id', $user->id);
        
        // Apply user filter for admin
        if ($isAdmin && $request->has('user_id')) {
            $query->where('register_id', $request->user_id);
        }
        
        // Apply date range filter
        if ($start && $end) {
            $query->whereBetween('transaction_date', [$start, $end]);
        }
        
        // Apply transaction type filter
        // if ($request->has('type') && in_array($request->type, ['income', 'expense'])) {
        //     $query->where('type', $request->type);
        // }
        
        // // Apply category filter
        // if ($request->has('category')) {
        //     $query->where('category', $request->category);
        // }
        
        // Get all transactions with applied filters
        $transactions = $query->orderBy('transaction_date', 'desc')->get();
        
        // Calculate totals based on filters
        $totalQuery = $isAdmin 
            ? Transaction::query()
            : Transaction::where('register_id', $user->id);
            
        if ($isAdmin && $request->has('user_id')) {
            $totalQuery->where('register_id', $request->user_id);
        }
        if ($start && $end) {
            $totalQuery->whereBetween('transaction_date', [$start, $end]);
        }
        if ($request->has('type') && in_array($request->type, ['income', 'expense'])) {
            $totalQuery->where('type', $request->type);
        }
        
        $totalIncome = (clone $totalQuery)->where('type', 'income')->sum('amount');
        $totalExpense = (clone $totalQuery)->where('type', 'expense')->sum('amount');
        $profit = $totalIncome - $totalExpense;
        
        // Get all users for admin filter
        $users = $isAdmin ? register::all() : [];
        
        // Get unique categories for filter
        $categories = $isAdmin 
            ? Transaction::distinct()->pluck('category')
            : Transaction::where('register_id', $user->id)->distinct()->pluck('category');

        return view('report', compact(
            'transactions', 
            'isAdmin', 
            'start', 
            'end', 
            'totalIncome', 
            'totalExpense', 
            'profit',
            'users',
            'categories',
            'request'
        ));
    }

}
