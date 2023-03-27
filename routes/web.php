<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ObjekWisataController;
use App\Http\Controllers\PenginapanController;
use App\Http\Controllers\UserController;
use App\Models\KategoriBerita;
use App\Models\KategoriWisata;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', [ObjekWisataController::class, 'index'])->name('objek-wisata.index');
Route::middleware('auth')->group(function () {
    // Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('chackrole:admin')->group(function () {
    // Routes that require an 'admin' role
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/{user}', [UserController::class, 'detail'])->name('user.detail');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/', [UserController::class, 'create'])->name('user.create');
        Route::put('/edit/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/{user}', [UserController::class, 'delete'])->name('user.delete');
    });

    Route::prefix('category-wisata')->group(function () {
        Route::get('/', [KategoriWisata::class, 'index'])->name('kwst.index');
        Route::get('/{kwst}', [KategoriWisata::class, 'detail'])->name('kwst.detail');
        Route::get('/edit/{kwst}', [KategoriWisata::class, 'edit'])->name('kwst.edit');
        Route::post('/', [KategoriWisata::class, 'create'])->name('kwst.create');
        Route::put('/edit{kwst}', [KategoriWisata::class, 'update'])->name('kwst.update');
        Route::delete('/', [KategoriWisata::class, 'delete'])->name('kwst.delete');
    });

    Route::prefix('category-berita')->group(function () {
        Route::get('/', [KategoriBerita::class, 'index'])->name('kbrt.index');
        Route::get('/{kbrt}', [KategoriBerita::class, 'detail'])->name('kbrt.detail');
        Route::get('/edit/{kbrt}', [KategoriBerita::class, 'edit'])->name('kbrt.edit');
        Route::post('/', [KategoriBerita::class, 'create'])->name('kbrt.create');
        Route::put('/edit{kbrt}', [KategoriBerita::class, 'update'])->name('kbrt.update');
        Route::delete('/', [KategoriBerita::class, 'delete'])->name('kbrt.delete');
    });

    Route::prefix('objek-wisata')->group(function () {
        Route::get('/', [ObjekWisataController::class, 'index'])->name('objwst.index');
        Route::get('/{objwst}', [ObjekWisataController::class, 'detail'])->name('objwst.detail');
        Route::get('/edit/{objwst}', [ObjekWisataController::class, 'edit'])->name('objwst.edit');
        Route::post('/', [ObjekWisataController::class, 'create'])->name('objwst.create');
        Route::put('/edit/{objwst}', [ObjekWisataController::class, 'update'])->name('objwst.update');
        Route::delete('/{objwst}', [ObjekWisataController::class, 'destroy'])->name('objwst.destroy');
    });

    Route::prefix('berita')->group(function () {
        Route::get('/', [BeritaController::class, 'index'])->name('berita.index');
        Route::get('/{berita}', [BeritaController::class, 'detail'])->name('berita.detail');
        Route::get('/edit/{berita}', [BeritaController::class, 'edit'])->name('berita.edit');
        Route::post('/', [BeritaController::class, 'create'])->name('berita.create');
        Route::put('/edit/{berita}', [BeritaController::class, 'update'])->name('berita.update');
        Route::delete('/{berita}', [BeritaController::class, 'destroy'])->name('objwst.destroy');
    });

    Route::prefix('karyawan')->group(function () {
        Route::get('/', [KaryawanController::class, 'index'])->name('karyawan.index');
        Route::get('/{karyawan}', [KaryawanController::class, 'detail'])->name('karyawan.detail');
        Route::get('/edit/{karyawan}', [KaryawanController::class, 'edit'])->name('karyawan.edit');
        Route::post('/', [KaryawanController::class, 'create'])->name('karyawan.create');
        Route::put('/edit/{karyawan}', [KaryawanController::class, 'update'])->name('karyawan.update');
        Route::delete('/{karyawan}', [KaryawanController::class, 'destroy'])->name('objwst.destroy');
    });

    Route::prefix('penginapan')->group(function () {
        Route::get('/', [PenginapanController::class, 'index'])->name('penginapan.index');
        Route::get('/{penginapan}', [PenginapanController::class, 'detail'])->name('penginapan.detail');
        Route::get('/edit/{penginapan}', [PenginapanController::class, 'edit'])->name('penginapan.edit');
        Route::post('/', [PenginapanController::class, 'create'])->name('penginapan.create');
        Route::put('/edit/{penginapan}', [PenginapanController::class, 'update'])->name('penginapan.update');
        Route::delete('/{penginapan}', [PenginapanController::class, 'destroy'])->name('objwst.destroy');
    });
});


Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('registrasi', [AuthController::class, 'register'])->name('register');
    Route::post('login/authentication', [AuthController::class, 'authenticate'])->name('login.authentication');
    Route::post('registrasi/authentication', [AuthController::class, 'registrasi'])->name('register.authentication');
});
