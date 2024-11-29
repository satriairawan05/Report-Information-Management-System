@extends('admin.layouts.app')

@section('main')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-block card-stretch card-transparent">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <div class="header-title">
                                <h4 class="card-title">{{ $name }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="h1">Welcome, {{ auth()->user()->name }}!</h2>
                    <h4 class="h5">“Untuk menang besar, terkadang Anda harus mengambil risiko yang besar pula.” - Bill Gates
                    </h4>
                </div>
            </div>
        </div>
    </div>
@endsection
