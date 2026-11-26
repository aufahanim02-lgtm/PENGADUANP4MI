
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH CONTROLLER
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Auth\ControllerAuthLogin;
use App\Http\Controllers\Auth\ControllerAuthUser;
use App\Http\Controllers\Auth\ControllerAuthLogout;

/*
|--------------------------------------------------------------------------
| DASHBOARD CONTROLLER
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Dashboard\ControllerDashboardAdmin;
use App\Http\Controllers\Dashboard\ControllerDashboardPetugas;
use App\Http\Controllers\Dashboard\ControllerDashboardPengadu;

/*
|--------------------------------------------------------------------------
| MASTER DATA CONTROLLER
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Master\ControllerUser;
use App\Http\Controllers\Master\ControllerPengadu;
use App\Http\Controllers\Master\ControllerKategori;
use App\Http\Controllers\Master\ControllerWilayah;

/*
|--------------------------------------------------------------------------
| PENGADUAN CONTROLLER
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Pengaduan\ControllerPengaduan;
use App\Http\Controllers\Pengaduan\ControllerBukti;
use App\Http\Controllers\Pengaduan\ControllerPengaduanAdmin;

/*
|--------------------------------------------------------------------------
| PMI CONTROLLER
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\PMI\ControllerPmi;
use App\Http\Controllers\PMI\ControllerPmiPengadu;

/*
|--------------------------------------------------------------------------
| TINDAK LANJUT CONTROLLER
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Tindaklanjut\ControllerTindaklanjut;
use App\Http\Controllers\Tindaklanjut\ControllerTindaklanjutAdmin;

/*
|--------------------------------------------------------------------------
| NOTIFIKASI CONTROLLER
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Notifikasi\ControllerNotifikasi;

/*
|--------------------------------------------------------------------------
| LAPORAN CONTROLLER
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Laporan\ControllerLaporan;


/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing.home');
})->name('landing.home');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/
Route::get('/login', [ControllerAuthLogin::class, 'showLogin'])
    ->name('login');

Route::post('/login', [ControllerAuthLogin::class, 'login'])
    ->name('login.proses');

Route::post('/logout', [ControllerAuthLogout::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| ADMINISTRATOR
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth:user', 'role:admin'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [ControllerDashboardAdmin::class, 'index'])
            ->name('dashboard');

        // Master Data
        Route::resource('user', ControllerUser::class);
        Route::resource('pengadu', ControllerPengadu::class);
        Route::resource('kategori', ControllerKategori::class);
        Route::resource('wilayah', ControllerWilayah::class);

        // Data PMI
        Route::resource('pmi', ControllerPmi::class);

        // Data Pengaduan
        Route::get('/pengaduan', [ControllerPengaduanAdmin::class, 'index'])
            ->name('pengaduan.index');

        Route::get('/pengaduan/{id}', [ControllerPengaduanAdmin::class, 'show'])
            ->name('pengaduan.show');

        Route::post('/pengaduan/{id}/tugaskan', [ControllerPengaduanAdmin::class, 'tugaskan'])
            ->name('pengaduan.tugaskan');

        // Data Tindak Lanjut
        Route::prefix('tindaklanjut')
            ->name('tindaklanjut.')
            ->controller(ControllerTindaklanjutAdmin::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{id}', 'show')->name('show');
            });

        // Laporan
        Route::prefix('laporan')
            ->name('laporan.')
            ->controller(ControllerLaporan::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/cetak', 'cetak')->name('cetak');
            });
    });


/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
Route::prefix('petugas')
    ->name('petugas.')
    ->middleware(['auth:user', 'role:petugas'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [ControllerDashboardPetugas::class, 'index'])
            ->name('dashboard');

        // Data Pengaduan
        Route::resource('pengaduan', ControllerPengaduan::class);

        // Verifikasi Pengaduan
        Route::patch('/pengaduan/{id}/verifikasi', [ControllerPengaduan::class, 'verifikasi'])
            ->name('pengaduan.verifikasi');

        // Bukti Pengaduan
        Route::prefix('pengaduan/{idpengaduan}/bukti')
            ->name('pengaduan.bukti.')
            ->controller(ControllerBukti::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/', 'store')->name('store');
                Route::get('/{idbukti}', 'show')->name('show');
                Route::put('/{idbukti}', 'update')->name('update');
                Route::delete('/{idbukti}', 'destroy')->name('destroy');
            });

        // Tindak Lanjut Pengaduan
        Route::prefix('pengaduan/{idpengaduan}/tindaklanjut')
            ->name('pengaduan.tindaklanjut.')
            ->controller(ControllerTindaklanjut::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::get('/{idtindaklanjut}', 'show')->name('show');
                Route::get('/{idtindaklanjut}/edit', 'edit')->name('edit');
                Route::put('/{idtindaklanjut}', 'update')->name('update');
                Route::delete('/{idtindaklanjut}', 'destroy')->name('destroy');
            });
    });


/*
|--------------------------------------------------------------------------
| PENGADU
|--------------------------------------------------------------------------
*/
Route::prefix('pengadu')
    ->name('pengadu.')
    ->middleware(['auth:pengadu', 'role:pengadu'])
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [ControllerDashboardPengadu::class, 'index'])
            ->name('dashboard');

        // Data Pengaduan
        Route::resource('pengaduan', ControllerPengaduan::class)
            ->except(['destroy']);

        // Data PMI
        Route::resource('pmi', ControllerPmiPengadu::class)
            ->except(['show']);

        // Notifikasi
        Route::prefix('notifikasi')
            ->name('notifikasi.')
            ->controller(ControllerNotifikasi::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::patch('/read-all', 'readAll')->name('readAll');
                Route::get('/{id}', 'show')->name('show');
                Route::patch('/{id}/read', 'read')->name('read');
                Route::delete('/{id}', 'destroy')->name('destroy');
            });

        // Profil Pengadu
        Route::get('/profil', [ControllerAuthUser::class, 'edit'])
            ->name('profil.edit');

        Route::put('/profil', [ControllerAuthUser::class, 'update'])
            ->name('profil.update');
    });
