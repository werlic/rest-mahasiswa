<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\UserMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class MahasiswaController extends Controller
{
    // public function __construct() 
    // {
    //     $this->middleware('auth');
    // }

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
            'email' => 'required|email|unique:mahasiswa,email',
            'fakultas' => 'required',
            'jurusan' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $mahasiswa = Mahasiswa::create([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'jk' => $request->jk,
                'jurusan_id' => $request->jurusan,
                'email' => $request->email,
                'alamat' => $request->alamat
            ]);
            $mahasiswa->user()->create([
                'password' => bcrypt($request->nim)
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }

        return redirect()->route('mahasiswa')->with('message-success', 'Berhasil menambah data!!');
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        $fakultas = Fakultas::with('jurusan')->orderBy('nama', 'asc')->get();
        return view('mahasiswa.edit', ['mahasiswa' => $mahasiswa, 'fakultas' => $fakultas]);
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $this->validate($request, [
            'nama' => 'required',
            'jk' => 'required',
            'email' => ['required','email', Rule::unique('mahasiswa')->ignore($mahasiswa->id)],
            'fakultas' => 'required',
            'jurusan' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $mahasiswa->update([
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

        return redirect()->route('mahasiswa')->with('message-success', 'Berhasil mengubah data!!');
    }

    public function profile()
    {
        $mahasiswa = Auth::guard('mahasiswa')->user()->mahasiswa()->first();
        $fakultas = Fakultas::with('jurusan')->orderBy('nama', 'asc')->get();
        return view('mahasiswa.profile', ['mahasiswa' => $mahasiswa, 'fakultas' => $fakultas]);
    }

    public function updateProfile(Request $request)
    {
        $mahasiswa = Auth::guard('mahasiswa')->user()->mahasiswa();
        $id = $mahasiswa->first()->id;
        $this->validate($request, [
            'nama' => 'required',
            'jk' => 'required',
            'email' => ['required', 'email', Rule::unique('mahasiswa')->ignore($id)],
            'fakultas' => 'required',
            'jurusan' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $mahasiswa->update([
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

        $fakultas = Fakultas::with('jurusan')->orderBy('nama', 'asc')->get();

        return redirect()->route('mahasiswa.profile', ['mahasiswa' => $mahasiswa, 'fakultas' => $fakultas])->with('message-success', 'Berhasil mengubah data!!');
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        DB::beginTransaction();
        try {
            $mahasiswa->user()->delete();
            $mahasiswa->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
        return redirect()->route('mahasiswa')->with('message-warning', 'Berhasil menghapus data!!');
    }
}
