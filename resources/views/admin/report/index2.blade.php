@extends('admin.layouts.app')


@section('main')
    <div class="content-page">
        <div class="container-fluid">
            {{-- Folder --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-block card-stretch card-transparent">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <div class="header-title">
                                <h4 class="card-title">{{ $name }} for {{ auth()->user()->name }}</h4>
                            </div>
                            @if ($access['Create'] == 1)
                                <div class="card-header-toolbar">
                                    <a href="{{ route('report.create',['folder_id' => request()->input('folder_id')]) }}" class="btn btn-success"><i
                                            class="fas fa-file-upload"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Folder List --}}
                @php
                    $newYear = date('Y');
                    $yearDisplayed = false; // Menyimpan status apakah tahun sudah ditampilkan
                @endphp

                @foreach ($report as $rep)
                    @php
                        $oldYear = $rep->year;
                    @endphp
                    <!-- Asumsi $reports adalah koleksi report yang Anda tampilkan -->
                    @if ($rep->year == $oldYear && !$yearDisplayed)
                        <div class="col-md-6 col-sm-6 col-lg-3">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <a href="?folder_id={{ request()->input('folder_id') }}&year={{ $rep->year }}"
                                            class="folder">
                                            <div
                                                class="icon-small {{ $rep->user_id == auth()->user()->id ? 'bg-primary' : 'bg-secondary' }} mb-4 rounded">
                                                <i class="fas fa-folder"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <p class="folder">
                                    <h5 class="mb-2">{{ $rep->year }}</h5>
                                    </p>
                                </div>
                            </div>
                        </div>

                        @php
                            $yearDisplayed = true; // Setel status bahwa tahun sudah ditampilkan
                        @endphp
                    @else
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
