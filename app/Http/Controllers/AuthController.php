<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('email_message', 'User invalid');
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('quiz.index')->with('success', 'You are Successfully Loggedin');
        } else {
            return redirect()->back()->with('password_message', 'Please Provide Correct Password');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|string|email|unique:users',
        'password' => 'required',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('admin.login')->with('register_success', 'Registration successful. Please login.');
}

    public function adminlogout()
    {
        Session::flush();

        Auth::logout();

        return redirect()->route('admin.login')->with('logout','You are Successfully Logout');
    }
}
