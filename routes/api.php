<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\MahasiswaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Mahasiswa;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['as' => 'api'], function () {
    Route::post('login', [AuthController::class, 'login'])->name('.login');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('.logout');
        Route::group(['prefix' => 'mahasiswa', 'as' => '.mahasiswa'], function () {
            Route::get('/', [MahasiswaController::class, 'index']);
            Route::get('/{nim}', [MahasiswaController::class, 'show'])->name('.show');
            Route::put('/{nim}', [MahasiswaController::class, 'update'])->name('.update');
        });
        Route::get('jurusan/mahasiswa', [MahasiswaController::class, 'mhsJurusan'])->name('.jurusan.mahasiswa');
        Route::get('jurusan/all', [MahasiswaController::class, 'jurusanAll'])->name('.jurusan.all');
        Route::get('jurusan/{fakultas}', [MahasiswaController::class, 'jurusan'])->name('.jurusan');
        Route::get('fakultas', [MahasiswaController::class, 'fakultas'])->name('.fakultas');
        Route::get('fakultas/mahasiswa', [MahasiswaController::class, 'mhsFakultas'])->name('.fakultas.mahasiswa');
    });
});