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
                                    <td>
                                        <a href="{{ route('mahasiswa.edit', ['mahasiswa' => $m->id]) }}" class="btn btn-warning btn-neutral"><i class="fa fa-edit"></i></a>
                                        <a href="#delete" onclick="event.preventDefault();hapus({{ $m->id }})" class="btn btn-danger btn-neutral"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal delete -->
    <div class="modal" tabindex="-1" role="dialog" id="ModalDelete">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger font-weight-bold">Yakin hapus data mahasiswa ini?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteData" action="" method="POST">
                        @method('DELETE')
                        @csrf
                        <button id="DeleteButton" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
    <script>
        function hapus(id) {
            var link = "{!! url('/mahasiswa/delete') !!}" + '/' + id;
            $('#deleteData').attr('action', link);
            $('#ModalDelete').modal('toggle');
        }
    </script>
@endsection
