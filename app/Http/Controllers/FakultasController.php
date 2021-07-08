<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FakultasController extends Controller
{
    public function index()
    {   
        $fakultas = Fakultas::orderBy('nama')->get();
        return view('fakultas.index', compact('fakultas'));
    }

    public function create()
    {
        return view('fakultas.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required'
        ]);

        DB::beginTransaction();
        try {
            Fakultas::create($request->only('nama'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }

        return redirect()->route('fakultas')->with('message-success', 'Berhasil menambah data!!');
    }

    public function edit(Fakultas $fakultas)
    {
        return view('fakultas.edit', ['fakultas' => $fakultas]);
    }

    public function update(Request $request, Fakultas $fakultas)
    {
        $this->validate($request, [
            'nama' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $fakultas->update($request->only('nama'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }

        return redirect()->route('fakultas')->with('message-success', 'Berhasil mengubah data!!');
    }

    public function destroy(Fakultas $fakultas)
    {
        DB::beginTransaction();
        try {
            $fakultas->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
        return redirect()->route('fakultas')->with('message-warning', 'Berhasil menghapus data!!');
    }
}
