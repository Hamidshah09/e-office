<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login(){
        return view('login.login');
    }
    public function dashboard(){
        $user = User::where('id', '=', Auth::id())
                        ->get(['name', 'id']);
        $user =  $user[0];                       
        return view('dashboard', compact('user'));
    }
    public function loginmatch(Request $request){
        $credential = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        
        if (Auth::attempt($credential)){
            return redirect()->route('dashboard');
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
