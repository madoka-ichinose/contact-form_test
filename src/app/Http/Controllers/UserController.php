<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 

class UserController extends Controller
{
    public function index(Request $request){
        return view('auth.register');
    }
    public function store(Request $request){
        
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',  
    ]);

    $user = new User();
    
    $user->name = $validatedData['name'];
    $user->email = $validatedData['email'];
    $user->password = Hash::make($validatedData['password']);  
    
    $user->save();

    return redirect('/login')->with('success', '新規メンバーが登録されました。');
    }
}
