@extends('layouts.app')

@section('landing')
    <div class="card-body">
        <div class="text-dark text-center">
            <div class="d-flex align-items-center justify-content-center">
                <img src="{{ asset('img/logo.png') }}" alt="{{ env('APP_NAME') }}" class="w-25 h-25">
            </div>
            <h1 class="h2">Report App</h1>
            <h3 class="h4">Sistem Informasi Manajemen Laporan di Dinas Pangan, Tanaman Pangan dan Holtikultural Provinsi
                Kalimantan Timur</h3>
        </div>
        <div class="mt-3 text-center">
            @if (auth()->user())
                <a href="{{ route('home') }}" class="btn btn-dark">Home</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-dark">Login</a>
                <a href="{{ route('register') }}" class="btn btn-dark">Register</a>
            @endif
        </div>
    </div>
@endsection
