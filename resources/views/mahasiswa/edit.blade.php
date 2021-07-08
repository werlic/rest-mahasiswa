@extends('layouts.main')

@section('title', 'Edit Data Mahasiswa')

@section('header')
    <div class="panel-header panel-header-sm">
    </div>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Data Mahasiswa</div>
                <div class="card-body">
                    <form action="{{ route('mahasiswa.update', ['mahasiswa' => $mahasiswa->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="">NIM</label>
                                <input type="text" name="nim" id="nim" class="form-control" value="{{ $mahasiswa->nim }}" placeholder="11933xxx" disabled>
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
                                <input type="text" name="nama" id="nama" class="form-control" placeholder="John F." value="{{ $mahasiswa->nama }}">
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
                                        <input class="form-check-input" type="radio" name="jk" id="jk" value="L" @if($mahasiswa->jk == 'L') checked @endif>
                                        Laki-laki
                                        <span class="form-check-sign"></span>
                                    </label>
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="jk" id="jk" value="P" @if($mahasiswa->jk == 'P') checked @endif>
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
                                <input type="text" name="email" id="email" class="form-control" placeholder="example@email.com" value="{{ $mahasiswa->email }}">
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
                                <textarea name="alamat" id="alamat" class="form-control" placeholder="Jl. ">{{ $mahasiswa->alamat }}</textarea>
                                @error('alamat')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                @php
                                $ind_fakultas = null;
                                @endphp
                                <label for="fakultas">Fakultas</label>
                                <select name="fakultas" id="fakultas" class="form-control" onchange="getJurusan({{ $mahasiswa->jurusan_id }})">
                                    <option>Pilih Fakultas</option>
                                    @foreach ($fakultas as $key => $item)
                                        <option value="{{ $item->id }}" @if($mahasiswa->jurusan->fakultas_id == $item->id) 
                                            selected
                                            @php 
                                            $ind_fakultas = $key;
                                            @endphp 
                                        @endif>{{ $item->nama }}</option>
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
                                    @isset($ind_fakultas)
                                        @foreach ($fakultas[$ind_fakultas]->jurusan as $j)
                                            <option value="{{ $j->id }}" @if($mahasiswa->jurusan->id == $j->id) selected @endif>{{ $j->nama }}</option>
                                        @endforeach
                                    @endisset
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
                                <a href="{{ route('mahasiswa') }}" class="btn btn-pill btn-secondary px-3 py-2">cancel</a>
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
        function getJurusan(jurusanAsal) {
            var fakultas = $('#fakultas').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('jurusan.in-fakultas') }}',
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
                    $('#jurusan option[value='+jurusanAsal+']').prop('selected', true);
                },
                error: function (data) {
                    alert('Tidak bisa mengambil data jurusan');
                }
            });
        }
    </script>
@endsection