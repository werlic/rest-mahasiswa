<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurusanController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $jurusan = Jurusan::with('fakultas')->orderBy('nama')->get();
        return view('jurusan.index', compact('jurusan'));
    }

    public function create()
    {
        $fakultas = Fakultas::orderBy('nama')->get();
        return view('jurusan.add', compact('fakultas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'fakultas' => 'required'
        ]);

        DB::beginTransaction();
        try {
            Jurusan::create([
                'nama' => $request->nama,
                'fakultas_id' => $request->fakultas
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            //return $e;
            redirect()->route('jurusan')->with('message-warning', 'Gagal menambah data!!');
        }

        return redirect()->route('jurusan')->with('message-success', 'Berhasil menambah data!!');
    }

    public function edit(Jurusan $jurusan)
    {
        $fakultas = Fakultas::orderBy('nama')->get();
        return view('jurusan.edit', ['jurusan' => $jurusan, 'fakultas' => $fakultas]);
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $this->validate($request, [
            'nama' => 'required',
            'fakultas' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $jurusan->update([
                'nama' => $request->nama,
                'fakultas_id' => $request->fakultas
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            //return $e;
            redirect()->route('jurusan')->with('message-warning', 'Gagal mengubah data!!');
        }

        return redirect()->route('jurusan')->with('message-success', 'Berhasil mengubah data!!');
    }

    public function destroy(Jurusan $jurusan)
    {
        DB::beginTransaction();
        try {
            $jurusan->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
        return redirect()->route('jurusan')->with('message-warning', 'Berhasil menghapus data!!');
    }

    public function jurusanFakultas(Request $request)
    {
        if (!$request->wantsJson()) {
            return response(['message' => 'Request invalid!!'], 400);
        }

        $jurusan = Jurusan::select('id', 'nama')->where('jurusan_id', $request->fakultas)
                    ->orderBy('nama', 'asc')
                    ->get();

        return response([
            'jurusan' => $jurusan,
            'message' => 'retrieve success!!'
        ], 200);
    }
}
