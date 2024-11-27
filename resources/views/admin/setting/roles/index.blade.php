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
                                <h4 class="card-title">{{ $name }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-body">
                            <div class="my-2">
                                <a href="{{ route('group.create') }}" class="btn btn-success"><i class="fas fa-pen"></i></a>
                            </div>
                            <div class="table-responsive">
                                <table class="table-striped table-bordered table data-table" role="grid" id="user-list-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($group as $g)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $g->group_name }}</td>
                                                <td>
                                                    <a href="{{ route('group.edit', $g->group_id) }}"
                                                        class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                    @if ($g->group_id != 1)
                                                        <form action="{{ route('group.destroy', $g->group_id) }}"
                                                            method="post" class="d-inline">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
