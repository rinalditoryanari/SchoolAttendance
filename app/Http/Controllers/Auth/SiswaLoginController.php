<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Presensi;
use App\Models\Mapel;
use Illuminate\Http\Request;

class SiswaLoginController extends Controller
{
  use AuthenticatesUsers;

  public function index()
  {
    $mapels = Auth::guard('siswa')->user()->kelas->mapels;
    $presensis = [];
    foreach ($mapels as $mapel) {
      $pertemuans = $mapel->pertemuans->where("keterangan", "masuk");
      foreach ($pertemuans as $pertemuan) {
        $presensis[] = $pertemuan->presensi->where('absensi_id', '!=', 2);
      }
    }
    return view('dashboard-siswa', [
      'title' => 'dashboard-siswa',
      'siswa' => Siswa::count(),
      'guru' => User::count(),
      'mapel' => Mapel::count(),
      'kelas' => Kelas::count(),
      'presensis' => $presensis[0],
    ]);
  }


  protected $redirectTo = 'siswa/index';

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  public function guard()
  {
    return Auth::guard('siswa');
  }

  public function showLoginForm()
  {

    if (Auth::user()) {
      return redirect('/');
    } else if (Auth::guard('siswa')->user()) {
      return redirect('/login/index');
    } else {
      $title = "login";
      return view('loginsiswa', compact('title'));
    }
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => 'required',
      'password' => 'required'
    ]);

    if (Auth::guard('siswa')->attempt($credentials)) {
      $request->session()->regenerate();
      return redirect()->intended('/siswa/index');
    }
    return back()->with('loginError', 'Login Failed!!');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    request()->session()->invalidate();

    request()->session()->regenerateToken();
    return back()->with('logout', 'Logout Success !!');
  }
}
