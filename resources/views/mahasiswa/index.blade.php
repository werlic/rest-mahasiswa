@extends('layouts.main')

@section('title', 'Data Mahasiswa')

@section('header')
    <div class="panel-header panel-header-sm">
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Data Mahasiswa</div>

                <div class="card-body">
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
                                <td>Jurusan</td>
                                <td>Fakultas</td>
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
