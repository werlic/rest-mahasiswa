<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function jurusanFakultas(Request $request)
    {
        if (!$request->wantsJson()) {
            return response(['message' => 'Request invalid!!'], 400);
        }

        $jurusan = Jurusan::select('id', 'nama')->where('fakultas_id', $request->fakultas)
                    ->orderBy('nama', 'asc')
                    ->get();

        return response([
            'jurusan' => $jurusan,
            'message' => 'retrieve success!!'
        ], 200);
    }
}
