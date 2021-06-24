<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mahasiswa = Mahasiswa::with('jurusan.fakultas')->orderBy('nama')->get();
        return view('mahasiswa.index', ['mahasiswa' => $mahasiswa]);
    }

    public function create()
    {
        $fakultas = Fakultas::orderBy('nama', 'asc')->get();
        return view('mahasiswa.add', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required|min:8|max:8|unique:mahasiswa,nim',
            'nama' => 'required',
            'jk' => 'required',
            'email' => 'required|unique:mahasiswa,email',
            'fakultas' => 'required',
            'jurusan' => 'required'
        ]);

        DB::beginTransaction();
        try {
            Mahasiswa::create([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'jurusan_id' => $request->jurusan,
                'email' => $request->email,
                'alamat' => $request->alamat
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }

        return redirect()->route('mahasiswa')->with('message-success', 'Berhasil memabah data!!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', ['mahasiswa' => $mahasiswa]);
    }
}
