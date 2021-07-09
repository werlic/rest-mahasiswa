<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MahasiswaResouce;
use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return response(['mahasiswa' => MahasiswaResouce::collection($mahasiswa), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show($nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        return response(['mahasiswa' => new MahasiswaResouce($mahasiswa), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nim)
    {
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();
        if ($request->has('email')) {
            $this->validate($request, [
                'email' => ['required', 'email', Rule::unique('mahasiswa')->ignore($mahasiswa->id)],
            ]);
        }
        $update = ['nama', 'jk', 'alamat', 'email'];

        DB::beginTransaction();
        try {
            $mahasiswa->update($request->only($update));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response(['message' => 'Failed update data!!','error' => true], 400);
        }

        return response(['message' => 'Update data success!!', 'error' => false]);
    }

    public function mhsJurusan(Request $request)
    {
        if (!$request->has('jurusan')) {
            return response(['message' => 'Failed retrieve data!!', 'error' => true], 400);
        }

        $mahasiswa = Mahasiswa::with('jurusan')->where('jurusan_id', $request->jurusan)
                    ->orderBy('nim')
                    ->get();

        return response(['mahasiswa' => MahasiswaResouce::collection($mahasiswa), 'message' => 'Retrieved successfully'], 200);
    }

    public function jurusan($fakultas)
    {
        $jurusan = Jurusan::with('fakultas')->where('fakultas_id', $fakultas)->orderBy('nama')->get();
        
        return response(['jurusan' => $jurusan, 'message' => 'Retrieved data successfully!!'], 200);
    }

    public function jurusanAll()
    {
        $jurusan = Jurusan::with('fakultas')->orderBy('nama')->get();

        return response(['jurusan' => $jurusan, 'message' => 'Retrieved data successfully!!'], 200);
    }

    public function fakultas()
    {
        $fakultas = Fakultas::orderBy('nama')->get();

        return response(['fakultas' => $fakultas, 'message' => 'Retrieved data successfully!!'], 200);
    }

    public function mhsFakultas(Request $request)
    {
        if (!$request->has('fakultas')) {
            return response(['message' => 'Failed retrieve data!!', 'error' => true], 400);
        }

        $mahasiswa = Mahasiswa::join('jurusan as j', 'mahasiswa.jurusan_id', '=', 'j.id')
        ->join('fakultas as f', 'j.fakultas_id', '=', 'f.id')
        ->select('mahasiswa.*', 'j.id', 'j.nama as jurusan', 'f.id', 'f.nama as fakultas')
        ->where('f.id', $request->fakultas)
            ->orderBy('j.nama')
            ->orderBy('mahasiswa.nim')
            ->get();

        return response(['mahasiswa' => MahasiswaResouce::collection($mahasiswa), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Mahasiswa $mahasiswa)
    // {
    //     //
    // }
}
