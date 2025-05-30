<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


use App\Models\register;
use Illuminate\Http\Request;

class registerController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            "username" => "required",
            "email" => "email|unique:register",
            "password" => "required|min:6",
        ]);
        $user = register::create([
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        return back()->with("message", "User succeessful register");
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'email',
            'password' => 'required|min:6',
        ]);
        $user = register::where('email','=',$request->email)->first();
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

        if (Session::has('loginId')) {
            $data = register::where('id', Session::get('loginId'))->first();
            return view('dashboard', compact('data'));
        }
    }
    public function logout()
    {
        if (Session::has('loginId')) {
            Session::pull('loginId');
        }
        return redirect()->route('login')->with('message', 'Logged out successfully');

    }

}
