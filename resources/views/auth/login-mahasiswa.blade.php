@extends('layouts.master')
@section('title', 'Login Mahasiswa')

@section('main')
<div class="app">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg  bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#pablo">Sistem Data Mahasiswa</a>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="content" style="min-height: calc(100vh - 200px)">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center"><h3>{{ __('Login') }}</h3></div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('auth.mahasiswa') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="nim" class="col-md-4 col-form-label text-md-right">{{ __('NIM') }}</label>

                                    <div class="col-md-6">
                                        <input id="nim" type="nim" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" required autofocus>

                                        @error('nim')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label" for="remember">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                {{ __('Remember Me') }}
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Login') }}
                                        </button>

                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        @include('layouts.footer')
    </footer>
</div>

@endsection
