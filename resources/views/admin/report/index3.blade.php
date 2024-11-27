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
                        </div>
                    </div>
                </div>
                {{-- Folder List --}}
                @php
                    $month = [
                        '01' => 'Januari',
                        '02' => 'Februari',
                        '03' => 'Maret',
                        '04' => 'April',
                        '05' => 'Mei',
                        '06' => 'Juni',
                        '07' => 'Juli',
                        '08' => 'Agustus',
                        '09' => 'September',
                        '10' => 'Oktober',
                        '11' => 'November',
                        '12' => 'Desember',
                    ];

                    $displayedMonths = []; // Menyimpan bulan yang sudah ditampilkan
                @endphp

                @foreach ($report as $rep)
                    @php
                        $newMonth = $rep->month;
                    @endphp
                    @if ($rep->month == $newMonth && !in_array($rep->month, $displayedMonths))
                        <div class="col-md-6 col-sm-6 col-lg-3">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <a href="?folder_id={{ request()->input('folder_id') }}&year={{ $rep->year }}&month={{ $rep->month }}"
                                            class="folder">
                                            <div
                                                class="icon-small {{ $rep->user_id == auth()->user()->id ? 'bg-primary' : 'bg-secondary' }} mb-4 rounded">
                                                <i class="fas fa-folder"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <p class="folder">
                                    <h5 class="mb-2">{{ $month[$rep->month] }}</h5>
                                    </p>
                                </div>
                            </div>
                        </div>
                        @php
                            // Menambahkan bulan ke array agar tidak ditampilkan lagi
                            $displayedMonths[] = $rep->month;
                        @endphp
                    @endif
                @endforeach

            </div>
        </div>
    </div>
@endsection
