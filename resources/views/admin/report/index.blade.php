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
                                <h4 class="card-title">Folder for {{ auth()->user()->name }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Folder List --}}
                @foreach ($folders as $folder)
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <a href="?folder_id={{ $folder->id }}" class="folder">
                                        <div
                                            class="icon-small {{ $folder->user_id == auth()->user()->id ? 'bg-primary' : 'bg-secondary' }} mb-4 rounded">
                                            <i class="fas fa-folder"></i>
                                        </div>
                                    </a>
                                </div>
                                <p class="folder">
                                <h5 class="mb-2">{{ $folder->name }}</h5>
                                <p class="mb-2"><i
                                        class="fas fa-clock {{ $folder->user_id == auth()->user()->id ? 'text-primary' : 'text-secondary' }} font-size-20 mr-2"></i>{{ $folder->created_at->format('l, d F Y') }}
                                </p>
                                <p class="mb-1"><i
                                        class="fas fa-user {{ $folder->user_id == auth()->user()->id ? 'text-primary' : 'text-secondary' }} font-size-20 mr-2"></i>
                                    {{ $folder->user_id == auth()->user()->id ? 'Me' : $folder->user->name }}</p>
                                @php
                                    $user = \App\Models\User::where('id',auth()->user()->id)->first();
                                    $reportCount = \App\Models\Report::where('folder_id', $folder->id)
                                        ->where('user_id', $user->id)
                                        ->count();
                                @endphp
                                <p class="mb-0"><i
                                        class="fas fa-file-archive {{ $folder->user_id == auth()->user()->id ? 'text-primary' : 'text-secondary' }} font-size-20 mr-2"></i>
                                    {{ $reportCount }} Files</p>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ $folders->links() }}
            </div>
        </div>
    </div>
@endsection
