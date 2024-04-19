<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function index() {
        return view('registrasi',[
            'title' => 'Registrasi',
            'active' => 'login'
        ]);
    }

    public function regis(Request $request)
    {
        $dataregis = $request->validate([
            'nama'      => 'required|max:255',
            'username'  => 'required|min:3|unique:users',
            'email'     => 'required|unique:users',
            'password'  => 'required|min:6|max:25'
        ]);

        $dataregis['password'] = Hash::make($dataregis['password']);

        User::create($dataregis);

        toast('Registrasi Berhasil','success');
        return redirect ('/login');
    }
}
