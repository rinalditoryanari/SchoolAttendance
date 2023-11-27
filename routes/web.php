<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AsdosController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\PresensiAdminController;
use App\Http\Controllers\PresensiGuruController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\DosenLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MahasiswaLoginController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PresensiMahasiswaController;
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
Route::post('/login', [LoginController::class, 'authenticate'])->name('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth');

// Home Routes
Route::get('/', [LoginController::class, 'redirect'])->middleware('auth');

// Siswa Export and Import Routes
Route::get('export', [MahasiswaController::class, 'export'])->name('export')->middleware('admin');
Route::post('import', [MahasiswaController::class, 'import'])->name('import')->middleware('admin');

// // Profile Routes
Route::prefix('/profile')->group(function () {
    Route::get('/{profile}', [ProfileController::class, 'show'])->name('profile');
});

//FOR SISWA USER
Route::prefix('mahasiswa')->group(function () {
    Route::middleware(['mahasiswa', 'auth'])->group(function () {
        //Admin Home page after login
        Route::get('/index', [MahasiswaLoginController::class, 'index'])->name('siswa.index');
        Route::get('/presensi', [PresensiMahasiswaController::class, 'showMapel'])->name('mahasiswa.presensi.showmapel');
        Route::get('/presensi/{mapel}', [PresensiMahasiswaController::class, 'showTgl'])->name('mahasiswa.presensi.detail');
        Route::get('/presensi/{mapel}/{pertemuan}', [PresensiMahasiswaController::class, 'showPresensi'])->name('mahasiswa.presensi.pertemuan');
        Route::post('/presensi/', [PresensiMahasiswaController::class, 'inputAbsensi'])->name('mahasiswa.presensi.absensi');
    });
});

// FOR GURU USER
Route::prefix('dosen')->group(function () {
    Route::middleware(['dosen', 'auth'])->group(function () {
        Route::get('/index', [DosenLoginController::class, 'dashboard']);

        Route::get('/presensi', [PresensiGuruController::class, 'showMapel'])->name('dosen.presensi.showmapel');
        Route::get('/presensi/{mapel}', [PresensiGuruController::class, 'showTgl'])->name('dosen.presensi.detail');
        Route::get('/presensi/{mapel}/{pertemuan}', [PresensiGuruController::class, 'showPresensi'])->name('dosen.presensi.pertemuan');
        Route::post('/presensi/', [PresensiGuruController::class, 'inputAbsensi'])->name('dosen.presensi.absensi');
    });
});


//FOR ADMIN USER
Route::prefix('admin')->group(function () {
    Route::middleware(['admin', 'auth'])->group(function () {
        Route::get('/index', [AdminLoginController::class, 'dashboard']);

        //NGATUR PRESENSI
        Route::prefix('presensi')->group(function () {
            Route::get('/', [PresensiAdminController::class, 'showMapel'])->name('admin.presensi.showmapel');

            Route::get('/tambah', [PresensiAdminController::class, 'showTambah'])->name('admin.presensi.showadd');
            Route::post('/tambah', [PresensiAdminController::class, 'inputTambah'])->name('admin.presensi.add');

            Route::get('/{mapel}', [PresensiAdminController::class, 'showTgl'])->name('admin.presensi.detail');
            Route::get('/{mapel}/edit', [PresensiAdminController::class, 'showEdit'])->name('admin.presensi.showedit');
            Route::post('/{mapel}/edit', [PresensiAdminController::class, 'inputEdit'])->name('admin.presensi.edit');

            Route::get('/{mapel}/hapus', [PresensiAdminController::class, 'deletePresensi'])->name('admin.presensi.delete');

            Route::get('/{mapel}/rekap/dosen', [PresensiAdminController::class, 'showRekapDosen'])->name('admin.presensi.rekap.dosen');
            Route::get('/{mapel}/rekap/mahasiswa', [PresensiAdminController::class, 'showPilihRekapMhsw'])->name('admin.presensi.rekap.mahasiswa');
            Route::get('/{mapel}/rekap/mahasiswa/id/{mahasiswa}', [PresensiAdminController::class, 'showRekapMhsw'])->name('admin.presensi.rekap.mahasiswa.detail');

            Route::get('/{mapel}/rekap/mahasiswa/excel', [PresensiAdminController::class, 'excelRekapMhsw'])->name('admin.presensi.rekap.mahasiswa.excel');
            Route::get('/{mapel}/rekap/mahasiswa/pdf/', [PresensiAdminController::class, 'pdfRekapMhsw'])->name('admin.presensi.rekap.mahasiswa.pdf');

            Route::get('/{mapel}/rekap/mahasiswa/review', [PresensiAdminController::class, 'reviewRekapMhsw']);

            Route::get('/{mapel}/{pertemuan}/dosen', [PresensiAdminController::class, 'showPresensiDosen'])->name('admin.presensi.pertemuan.dosen');
            Route::get('/{mapel}/{pertemuan}/mahasiswa', [PresensiAdminController::class, 'showPresensiMhsw'])->name('admin.presensi.pertemuan.mahasiswa');
        });

        Route::prefix('/mapel')->group(function () {
            Route::get('/', [MapelController::class, 'showAllMapel'])->name('admin.mapel.showall');
            Route::post('/', [MapelController::class, 'addMapel'])->name('admin.mapel.add');
            Route::get('/create', [MapelController::class, 'showAddMapel'])->name('admin.mapel.showadd');
            Route::get('/{mapel}/edit', [MapelController::class, 'showEditMapel'])->name('admin.mapel.showedit');
            Route::put('/{mapel}', [MapelController::class, 'update'])->name('admin.mapel.edit');
            Route::delete('/{mapel}', [MapelController::class, 'destroy'])->name('admin.mapel.delete');
        });

        //NGATUR ABSEN GURU
        Route::prefix('dosen')->group(function () {
            Route::get('/', [DosenController::class, 'showAllDosen'])->name('admin.dosen.showall');

            Route::get('/create', [DosenController::class, 'showAddDosen'])->name('admin.dosen.showadd');
            Route::post('/create', [DosenController::class, 'addDosen'])->name('admin.dosen.add');

            Route::get('/{dosen}', [DosenController::class, 'detailDosen'])->name('admin.dosen.detail');

            Route::get('/{dosen}/edit', [DosenController::class, 'showEditDosen'])->name('admin.dosen.showedit');
            Route::put('/{dosen}', [DosenController::class, 'update'])->name('admin.dosen.edit');

            Route::delete('/{dosen}', [DosenController::class, 'delete'])->name('admin.dosen.delete');

            Route::get('/{dosen}/rekap/review', [DosenController::class, 'reviewRekap']);
            Route::get('/{dosen}/rekap/excel', [DosenController::class, 'excelRekap'])->name('admin.dosen.rekap.excel');
            Route::get('/{dosen}/rekap/pdf', [DosenController::class, 'pdfRekap'])->name('admin.dosen.rekap.pdf');
        });

        Route::prefix('/kelas')->group(function () {
            Route::get('/', [KelasController::class, 'showAllKelas'])->name('admin.kelas.showall');
            Route::post('/', [KelasController::class, 'addKelas'])->name('admin.kelas.add');
            Route::get('/create', [KelasController::class, 'showAddKelas'])->name('admin.kelas.showadd');
            Route::get('/{kelas}/edit', [KelasController::class, 'showEditKelas'])->name('admin.kelas.showedit');
            Route::put('/{kelas}', [KelasController::class, 'update'])->name('admin.kelas.edit');
            Route::delete('/{kelas}', [KelasController::class, 'delete'])->name('admin.kelas.delete');
        });

        Route::prefix('/mahasiswa')->group(function () {
            Route::get('/', [MahasiswaController::class, 'showAllMhsw'])->name('admin.mahasiswa.showall');
            Route::post('/', [MahasiswaController::class, 'addMhsw'])->name('admin.mahasiswa.add');
            Route::get('/create', [MahasiswaController::class, 'showAddMhsw'])->name('admin.mahsiswa.showadd');
            Route::get('/{mahasiswa}', [MahasiswaController::class, 'detailMhsw'])->name('admin.mahasiswa.detail');
            Route::get('/{mahasiswa}/edit', [MahasiswaController::class, 'showEditMhsw'])->name('admin.mahasiswa.showedit');
            Route::put('/{mahasiswa}', [MahasiswaController::class, 'update'])->name('admin.mahasiswa.edit');
            Route::delete('/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('admin.mahasiswa.delete');
        });

        Route::prefix('/keteranganPresensi')->group(function () {
            Route::get('/', [AbsensiController::class, 'showAllAbsensi'])->name('admin.absensi.showall');
            Route::post('/', [AbsensiController::class, 'addAbsensi'])->name('admin.absensi.add');
            Route::get('/create', [AbsensiController::class, 'showAddAbsensi'])->name('admin.absensi.showadd');
            Route::get('/{absensi}/edit', [AbsensiController::class, 'showEditAbsensi'])->name('admin.absensi.showedit');
            Route::put('/{absensi}', [AbsensiController::class, 'update'])->name('admin.absensi.edit');
            Route::delete('/{absensi}', [AbsensiController::class, 'destroy'])->name('admin.absensi.delete');
        });

        Route::prefix('/asdos')->group(function () {
            Route::get('/', [AsdosController::class, 'showAllAsdos'])->name('admin.asdos.showall');
            Route::post('/', [AsdosController::class, 'addAsdos'])->name('admin.asdos.add');
            Route::get('/create', [AsdosController::class, 'showAddAsdos'])->name('admin.asdos.showadd');
            Route::get('/{asdos}', [AsdosController::class, 'detailAsdos'])->name('admin.asdos.detail');
            Route::get('/{asdos}/edit', [AsdosController::class, 'showEditAsdos'])->name('admin.asdos.showedit');
            Route::put('/{asdos}', [AsdosController::class, 'update'])->name('admin.asdos.edit');
            Route::delete('/{asdos}', [AsdosController::class, 'delete'])->name('admin.asdos.delete');
        });
    });
});
