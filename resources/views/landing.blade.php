@extends('layouts.app')

@section('landing')
    <div class="card-body">
        <div class="text-dark text-center">
            <div class="d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="w-25 h-25">
</div>
    
    <h3 class="h4" style="margin-top: 5px; margin-bottom: 5px;">Manajemen Laporan Harian Bidang Hortikultura </h3>
    <h3 class="h4" style="margin-top: 5px; margin-bottom: 5px;">Pada Dinas Pangan Kota Samarinda Berbasis Web</h3>
    <h1 class="h5" style="font-style: italic; margin-top: 10px; margin-bottom: 10px;">Silahkan Masuk untuk Mengakses Sistem</h1>
</div>

        <div class="mt-3 text-center">
            @if (auth()->user())
                <a href="{{ route('home') }}" class="btn btn-dark">Home</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-dark">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-dark">Register</a>
            @endif
        </div>
    </div>
@endsection
