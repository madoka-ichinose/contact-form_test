<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function index(Request $request){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
        'email' => 'required|email',
        'password' => 'required',
         ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
             return redirect('/admin'); 
        }else{

        return redirect()->back()->withErrors([
            'email' => '認証に失敗しました。',
        ]);
        }
    }

    public function logout(Request $request)
    {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
    }

}
