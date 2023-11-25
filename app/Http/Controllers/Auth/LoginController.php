<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return redirect('/');
        } else {
            return view('login', [
                'title' => 'Login'
            ]);
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)) {
            // dd(auth()->user()->role);
            if (auth()->user()->role == 0) {
                //Admin
                return redirect()->intended('/admin/index');
            } else if (auth()->user()->role == 1) {
                //Mahasiswa
                return redirect()->intended('/mahasiswa/index');
            } else if (auth()->user()->role == 2) {
                //Dosen
                return redirect()->intended('/dosen/index');
            }
        }
        return back()->with('loginError', 'Login gagal!');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    }

    public function redirect()
    {
        // dd(auth()->user()->role);
        if (auth()->user()->role == 0) {
            //Admin
            return redirect()->intended('/admin/index');
        } else if (auth()->user()->role == 1) {
            //Mahasiswa
            return redirect()->intended('/mahasiswa/index');
        } else if (auth()->user()->role == 2) {
            //Dosen
            return redirect()->intended('/dosen/index');
        }
    }
}
