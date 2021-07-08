@extends('layouts.main')

@section('title', 'Tambah Data Jurusan')

@section('header')
    <div class="panel-header panel-header-sm">
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tambah Data Jurusan</div>
                <div class="card-body">
                    <form action="{{ route('jurusan.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="">Nama Jurusan</label>
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="ex: Psikologi">
                                @error('nama')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="">Fakultas</label>
                                <select name="fakultas" id="fakultas" class="form-control">
                                    <option>Pilih Fakultas</option>
                                    @foreach ($fakultas as $f)
                                        <option value="{{ $f->id }}">{{ $f->nama }}</option>
                                    @endforeach
                                </select>
                                @error('fakultas')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" value="Save" class="btn btn-pill btn-primary px-3 py-2">Submit</button>
                                <a href="{{ route('jurusan') }}" class="btn btn-pill btn-secondary px-3 py-2">cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection