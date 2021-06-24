<?php

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

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'mahasiswa', 'as' => 'mahasiswa'], function () {
    Route::get('', [MahasiswaController::class, 'index']);
    Route::get('create', [MahasiswaController::class, 'create'])->name('.create');
    Route::post('store', [MahasiswaController::class, 'store'])->name('.store');
    Route::get('edit/{mahasiswa}', [MahasiswaController::class, 'edit'])->name('.edit');
    Route::put('update/{mahasiswa}', [MahasiswaController::class, 'update'])->name('.update');
    Route::delete('delete/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('.delete');
});
Route::group(['prefix' => 'jurusan', 'as' => 'mahasiswa'], function () {
    Route::get('/in-fakultas', [JurusanController::class, 'jurusanFakultas'])->name('.in-fakultas');
});
