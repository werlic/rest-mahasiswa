@extends('layouts.main')

@section('title', 'Data Mahasiswa')

@section('header')
    <div class="panel-header panel-header-sm">
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Data Mahasiswa</h2>
                </div>
                <div class="card-body">
                    @if(session()->has('message-success'))
                        <div class="alert alert-dissmisable alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>
                            {!! session()->get('message-success') !!}
                        </strong>
                        </div>
                    @endif
                    @if(session()->has('message-warning'))
                        <div class="alert alert-dissmisable alert-warning">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>
                            {!! session()->get('message-warning') !!}
                        </strong>
                        </div>
                    @endif
                        
                    @endif
                    <div class="col-md-2 col-4">
                        <a href="{{ route('mahasiswa.create') }}" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table" id="datatable">
                            <thead>
                                <th>No.</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Jurusan</th>
                                <th>Fakultas</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Opsi</th>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($mahasiswa as $m)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $m->nim }}</td>
                                    <td>{{ $m->nama }}</td>
                                    <td>{{ $m->jk }}</td>
                                    <td>{{ $m->jurusan->nama}}</td>
                                    <td>{{ $m->jurusan->fakultas->nama }}</td>
                                    <td>{{ $m->email }}</td>
                                    <td>{{ $m->alamat }}</td>
                                    <td>Opsi</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
