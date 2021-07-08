<?php

use App\Http\Controllers\Auth\LoginUserMhsController;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;
use App\Models\Mahasiswa;

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


Route::group(['prefix' => 'admin'], function (){
    Auth::routes(['register' => false]);
    Route::group(['middleware' => ['auth:web']], function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'admin'])->name('admin');
        Route::group(['prefix' => 'mahasiswa', 'as' => 'mahasiswa'], function () {
            Route::get('', [MahasiswaController::class, 'index']);
            Route::get('create', [MahasiswaController::class, 'create'])->name('.create');
            Route::post('store', [MahasiswaController::class, 'store'])->name('.store');
            Route::get('edit/{mahasiswa}', [MahasiswaController::class, 'edit'])->name('.edit');
            Route::put('update/{mahasiswa}', [MahasiswaController::class, 'update'])->name('.update');
            Route::delete('delete/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('.delete');
        });
        Route::group(['prefix' => 'jurusan', 'as' => 'jurusan'], function () {
            Route::get('/in-fakultas', [JurusanController::class, 'jurusanFakultas'])->name('.in-fakultas');
        });
        Route::group(['prefix' => 'fakultas', 'as' => 'fakultas'], function () {
            Route::get('/', [FakultasController::class, 'index']);
            Route::get('create', [FakultasController::class, 'create'])->name('.create');
            Route::post('store', [FakultasController::class, 'store'])->name('.store');
            Route::get('edit/{fakultas}', [FakultasController::class, 'edit'])->name('.edit');
            Route::put('update/{fakultas}', [FakultasController::class, 'update'])->name('.update');
            Route::delete('delete/{fakultas}', [FakultasController::class, 'destroy'])->name('.delete');
        });
    });
});

Route::get('login', [LoginUserMhsController::class, 'login'])->name('login.mahasiswa');
Route::post('auth', [LoginUserMhsController::class, 'authenticate'])->name('auth.mahasiswa');

Route::group(['middleware' => 'auth:mahasiswa'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::group(['prefix' => 'mahasiswa', 'as' => 'mahasiswa'], function () {
        Route::get('profile', [MahasiswaController::class, 'profile'])->name('.profile');
        Route::put('update/profile', [MahasiswaController::class, 'updateProfile'])->name('.update-profile');
        Route::group(['prefix' => 'jurusan', 'as' => '.jurusan'], function () {
            Route::get('/in-fakultas', [JurusanController::class, 'jurusanFakultas'])->name('.in-fakultas');
        });
    });
    Route::post('logout', [LoginUserMhsController::class, 'logout'])->name('logout.mahasiswa');
});

