@extends('admin.layouts.app')

@push('loader')
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
@endpush

@section('main')
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                {{-- Folder --}}
                <div class="col-lg-12">
                    <div class="card card-block card-stretch card-transparent">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <div class="header-title">
                                <h4 class="card-title">Personal {{ $name }} : {{ $userActive->name }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table-striped table-bordered table" role="grid" id="user-list-table">
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $userActive->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $userActive->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Induk Pegawai</th>
                                            <td>{{ $userActive->nip ?? 'User ini tidak memiliki Nomor Induk Pegawai' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pangkat/Golongan</th>
                                            <td>{{ $userActive->pangkat ?? 'User ini tidak memiliki Pangkat' }}/{{ $userActive->golongan ?? 'User ini tidak meiliki Golongan' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Jabatan</th>
                                            <td>{{ $userActive->jabatan ?? 'User ini tidak memiliki Jabatan' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Role</th>
                                            <td>{{ $userActive->role->group_name ?? 'User tidak memiliki Role' }}</td>
                                        </tr>
                                        @if ($access["Update"] == 1)
                                            <tr class="text-center">
                                                <th colspan="2"><a href="{{ route('profile.edit', $userActive->id) }}"
                                                        class="text-dark btn btn-primary">Update Data</a></th>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
