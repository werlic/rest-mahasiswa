@extends('layouts.master')

@section('main')
<div class="wrapper ">
    @include('layouts.sidebar')
    <div class="main-panel" id="main-panel">
      @yield('navbar')
      <div class="panel-header panel-header-lg">
      </div>
      <div class="content">
        @yield('content')
      </div>
      <footer class="footer">
        @include('layouts.footer')
      </footer>
    </div>
</div>
@endsection