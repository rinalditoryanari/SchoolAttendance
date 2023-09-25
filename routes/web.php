<?php

use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Presensi;
use App\Models\Siswa;
use App\Models\User;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\GuruAdminController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\PresensiAdminController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\PresensiGuruController;
use App\Http\Controllers\PresensiSiswaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\SiswaLoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Login Routes
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

// // Resgister Routes
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Home Routes
Route::get('/', function () {
    if (Auth::guard('siswa')->user()) {
        return redirect('/siswa/index');
    } elseif (Auth::user()) {
        return view('home.contents.welcome', [
            'title' => 'Dashboard',
            'siswa' => Siswa::count(),
            'guru' => User::count(),
            'mapel' => Mapel::count(),
            'kelas' => Kelas::count(),
            'presensis' => Presensi::where('guru_id', 0)->where('absensi_id', '!=', 2)->latest()->get()
        ]);
    } else {
        return redirect('/login');
    }
});

// Siswa Export and Import Routes
Route::get('export', [SiswaController::class, 'export'])->name('export')->middleware('auth');
Route::post('import', [SiswaController::class, 'import'])->name('import')->middleware('auth');

// // Presensi Routes
// Route::get('/presensi', [PresensiController::class, 'indexinti'])->middleware('auth');
// Route::post('/presensi', [PresensiController::class, 'store'])->middleware('auth');
// Route::get('/presensi/{mapel}/create', [PresensiController::class, 'create'])->middleware('auth');
// Route::get('/mapel/{id}/presensi/{created_at}', [PresensiController::class, 'show'])->middleware('auth');

// // Riwayat Presensi Routes
// Route::resource('/riwayatPresensi', PresensiController::class)->only('index', 'show')->middleware('auth');

// // Profile Routes
Route::prefix('/profile')->group(function () {
    Route::get('/{profile}', [ProfileController::class, 'show']);
});

//FOR SISWA USER
Route::prefix('siswa')->group(function () {
    Route::get('/login', [SiswaLoginController::class, 'showLoginForm'])->name('siswa.login')->middleware('guest');;
    Route::post('/', [SiswaLoginController::class, 'login'])->name('siswa.login.post');

    Route::middleware(['siswa'])->group(function () {
        Route::get('/logout', [SiswaLoginController::class, 'logout'])->name('siswa.logout');

        //Admin Home page after login
        Route::get('/index', [SiswaLoginController::class, 'index'])->name('siswa.index');
        Route::get('/presensi', [PresensiSiswaController::class, 'showMapel']);
        Route::get('/presensi/{mapel}', [PresensiSiswaController::class, 'showTgl']);
        Route::get('/presensi/{mapel}/{pertemuan}', [PresensiSiswaController::class, 'showPresensi']);
        Route::post('/presensi/', [PresensiSiswaController::class, 'inputAbsensi']);
    });
});

// FOR GURU USER
Route::prefix('guru')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/presensi', [PresensiGuruController::class, 'showMapel']);
        Route::get('/presensi/{mapel}', [PresensiGuruController::class, 'showTgl']);
        Route::get('/presensi/{mapel}/{pertemuan}', [PresensiGuruController::class, 'showPresensi']);
        Route::post('/presensi/', [PresensiGuruController::class, 'inputAbsensi']);
    });
});


//FOR ADMIN USER
Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
        //NGATUR PRESENSI
        Route::prefix('presensi')->group(function () {
            Route::get('/', [PresensiAdminController::class, 'showMapel']);

            Route::get('/tambah', [PresensiAdminController::class, 'showTambah']);
            Route::post('/tambah', [PresensiAdminController::class, 'inputTambah']);

            Route::get('/{mapel}', [PresensiAdminController::class, 'showTgl']);
            Route::get('/{mapel}/edit', [PresensiAdminController::class, 'showEdit']);
            Route::post('/{mapel}/edit', [PresensiAdminController::class, 'inputEdit']);

            Route::get('/{mapel}/hapus', [PresensiAdminController::class, 'deletePresensi']);

            Route::get('/{mapel}/rekap/guru', [PresensiAdminController::class, 'showRekapGuru']);
            Route::get('/{mapel}/rekap/siswa', [PresensiAdminController::class, 'showPilihRekapSiswa']);
            Route::get('/{mapel}/rekap/siswa/id/{siswa}', [PresensiAdminController::class, 'showRekapSiswa']);

            Route::get('/{mapel}/rekap/siswa/excel', [PresensiAdminController::class, 'excelRekapSiswa']);
            Route::get('/{mapel}/rekap/siswa/pdf/', [PresensiAdminController::class, 'pdfRekapSiswa']);

            Route::get('/{mapel}/rekap/siswa/review', [PresensiAdminController::class, 'reviewRekapSiswa']);

            Route::get('/{mapel}/{pertemuan}/guru', [PresensiAdminController::class, 'showPresensiGuru']);
            Route::get('/{mapel}/{pertemuan}/siswa', [PresensiAdminController::class, 'showPresensiSiswa']);
        });

        // Route::resource('/mapel', MapelController::class)->except(['show']);
        Route::prefix('/mapel')->group(function () {
            Route::get('/', [MapelController::class, 'index']);
            Route::post('/', [MapelController::class, 'store']);
            Route::get('/create', [MapelController::class, 'create']);
            Route::get('/{mapel}/edit', [MapelController::class, 'edit']);
            Route::put('/{mapel}', [MapelController::class, 'update']);
            Route::delete('/{mapel}', [MapelController::class, 'destroy']);
        });

        // Route::resource('/guru', UserController::class)->middleware('auth');
        //NGATUR ABSEN GURU
        Route::prefix('guru')->group(function () {
            Route::get('/', [UserController::class, 'index']);

            Route::get('/create', [UserController::class, 'create']);
            Route::post('/', [UserController::class, 'store']);

            Route::get('/{user}', [UserController::class, 'show']);

            Route::get('/{user}/edit', [UserController::class, 'edit']);
            Route::put('/{user}', [UserController::class, 'update']);

            Route::delete('/{user}', [UserController::class, 'destroy']);

            Route::get('/{guru}/rekap/review', [GuruAdminController::class, 'reviewRekap']);
            Route::get('/{guru}/rekap/excel', [GuruAdminController::class, 'excelRekap']);
            Route::get('/{guru}/rekap/pdf', [GuruAdminController::class, 'pdfRekap']);
        });

        // Route::resource('/kelas', KelasController::class)->except(['show'])->middleware('auth');
        Route::prefix('/kelas')->group(function () {
            Route::get('/', [KelasController::class, 'index']);
            Route::post('/', [KelasController::class, 'store']);
            Route::get('/create', [KelasController::class, 'create']);
            Route::get('/{kela}/edit', [KelasController::class, 'edit']);
            Route::put('/{kela}', [KelasController::class, 'update']);
            Route::delete('/{kela}', [KelasController::class, 'destroy']);
        });

        // Route::resource('/siswa', SiswaController::class)->middleware('auth');
        Route::prefix('/siswa')->group(function () {
            Route::get('/', [SiswaController::class, 'index']);
            Route::post('/', [SiswaController::class, 'store']);
            Route::get('/create', [SiswaController::class, 'create']);
            Route::get('/{siswa}', [SiswaController::class, 'show']);
            Route::get('/{siswa}/edit', [SiswaController::class, 'edit']);
            Route::put('/{siswa}', [SiswaController::class, 'update']);
            Route::delete('/{siswa}', [SiswaController::class, 'destroy']);
        });

        // Route::resource('/keteranganPresensi', AbsensiController::class)->except(['show'])->middleware('auth');
        Route::prefix('/keteranganPresensi')->group(function () {
            Route::get('/', [AbsensiController::class, 'index']);
            Route::post('/', [AbsensiController::class, 'store']);
            Route::get('/create', [AbsensiController::class, 'create']);
            Route::get('/{keteranganPresensi}/edit', [AbsensiController::class, 'edit']);
            Route::put('/{keteranganPresensi}', [AbsensiController::class, 'update']);
            Route::delete('/{keteranganPresensi}', [AbsensiController::class, 'destroy']);
        });
    });
});
