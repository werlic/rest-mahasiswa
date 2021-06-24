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
                <div class="card-header">Data Mahasiswa</div>
                <div class="card-body">
                    <form action="{{ route('mahasiswa.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="">NIM</label>
                                <input type="text" name="nim" id="nim" class="form-control">
                                @error('nim')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control">
                                @error('nama')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="jk" id="jk" value="L" selected>
                                        Laki-laki
                                        <span class="form-check-sign"></span>
                                    </label>
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="jk" id="jk" value="P" >
                                        Perempuan
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                @error('jk')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="example@email.com">
                                @error('email')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" class="form-control" placeholder="Jl. "></textarea>
                                @error('alamat')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="fakultas">Fakultas</label>
                                <select name="fakultas" id="fakultas" class="form-control" onchange="getJurusan()">
                                    <option>Pilih Fakultas</option>
                                    @foreach ($fakultas as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                                @error('fakultas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="jurusan">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-control">
                                    <option>Pilih Jurusan</option>
                                </select>
                                @error('jurusan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" value="Save" class="btn btn-pill btn-primary px-3 py-2">Submit</button>
                                <a href="{{ redirect()->back() }}" class="btn btn-pill btn-secondary px-3 py-2">cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-script')
    <script>
        function getJurusan() {
            $('#fakultas').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ url('/') }}' + '/jurusan/in-fakultas',
                type: "GET",
                dataType: 'json',
                data: {
                    fakultas: $('#fakultas').val()
                },
                success: function (data) {
                    var html = '<option>Pilih Jurusan</option>';
                    $('#jurusan').html('');
                    $.each(data.jurusan, function (index, value) {
                        html += '<option value="' + value.id + '">' + value.nama + '</option>'
                    });
                    $('#jurusan').html(html);
                },
                error: function (data) {
                    alert('Tidak bisa mengambil data jurusan');
                }
            });
        }
    </script>
@endsection