<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {
        return view('login',[
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function login(Request $request)
    {
        $datalogin = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($datalogin)){

            $request->session()->regenerate();
            if(Auth::user()->role_id == 1){
                toast('Login Berhasil','success');
                return redirect('/admin');
            }
            
            if(Auth::user()->role_id == 2) {
                toast('Login Berhasil','success');
                return redirect('/post');
            }
            
        }
        toast('Gagal Login !!','error');
        return redirect('/login');
    }

    public function logout(){
        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/login');
    }

}
