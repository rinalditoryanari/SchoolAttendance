<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MahasiswaLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/mahasiswa/home';

    public function __construct()
    {
      $this->middleware('guest')->except('logout');
    }

    public function guard()
    {
     return Auth::guard('mahasiswa');
    }
    public function showLoginForm()
    {
      return view('mahasiswa');
    }
}
