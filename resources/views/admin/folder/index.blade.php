@extends('admin.layouts.app')

@push('css')
    <!-- Viewer Plugin -->
    <!--PDF-->
    <link rel="stylesheet" href="{{ asset('cloudbox/assets/vendor/doc-viewer/include/pdf/pdf.viewer.css') }}">
    <!--Docs-->
    <!--PPTX-->
    <link rel="stylesheet" href="{{ asset('cloudbox/assets/vendor/doc-viewer/include/PPTXjs/css/pptxjs.css') }}">
    <link rel="stylesheet" href="{{ asset('cloudbox/assets/vendor/doc-viewer/include/PPTXjs/css/nv.d3.min.css') }}">
    <!--All Spreadsheet -->
    <link rel="stylesheet" href="{{ asset('cloudbox/assets/vendor/doc-viewer/include/SheetJS/handsontable.full.min.css') }}">
    <!--Image viewer-->
    <link rel="stylesheet"
        href="{{ asset('cloudbox/assets/vendor/doc-viewer/include/verySimpleImageViewer/css/jquery.verySimpleImageViewer.css') }}">
    <!--officeToHtml-->
    <link rel="stylesheet" href="{{ asset('cloudbox/assets/vendor/doc-viewer/include/officeToHtml/officeToHtml.css') }}">
@endpush

@push('js')
    <!-- Viewer Plugin -->
    <!--PDF-->
    <script src="{{ asset('cloudbox/assets/vendor/doc-viewer/include/pdf/pdf.js') }}"></script>
    <!--Docs-->
    <script src="{{ asset('cloudbox/assets/vendor/doc-viewer/include/docx/jszip-utils.js') }}"></script>
    <script src="{{ asset('cloudbox/assets/vendor/doc-viewer/include/docx/mammoth.browser.min.js') }}"></script>
    <!--PPTX-->
    <script src="{{ asset('cloudbox/assets/vendor/doc-viewer/include/PPTXjs/js/filereader.js') }}"></script>
    <script src="{{ asset('cloudbox/assets/vendor/doc-viewer/include/PPTXjs/js/d3.min.js') }}"></script>
    <script src="{{ asset('cloudbox/assets/vendor/doc-viewer/include/PPTXjs/js/nv.d3.min.js') }}"></script>
    <script src="{{ asset('cloudbox/assets/vendor/doc-viewer/include/PPTXjs/js/pptxjs.js') }}"></script>
    <script src="{{ asset('cloudbox/assets/vendor/doc-viewer/include/PPTXjs/js/divs2slides.js') }}"></script>
    <!--All Spreadsheet -->
    <script src="{{ asset('cloudbox/assets/vendor/doc-viewer/include/SheetJS/handsontable.full.min.js') }}"></script>
    <script src="{{ asset('cloudbox/assets/vendor/doc-viewer/include/SheetJS/xlsx.full.min.js') }}"></script>
    <!--Image viewer-->
    <script
        src="{{ asset('cloudbox/assets/vendor/doc-viewer/include/verySimpleImageViewer/js/jquery.verySimpleImageViewer.js') }}">
    </script>
    <!--officeToHtml-->
    <script src="{{ asset('cloudbox/assets/vendor/doc-viewer/include/officeToHtml/officeToHtml.js') }}"></script>
    <!-- app Doc Viewer-->
    <script src="{{ asset('cloudbox/assets/js/doc-viewer.js') }}" defer></script>
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
                                <h4 class="card-title">{{ $name }} for {{ auth()->user()->name }}</h4>
                            </div>
                            @if ($access['Create'] == 1)
                                <div class="card-header-toolbar">
                                    <a href="{{ route('folder.create') }}" class="btn btn-success"><i
                                            class="fas fa-folder-plus"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @foreach ($folders as $folder)
                    <div class="col-md-6 col-sm-6 col-lg-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="folder">
                                    <div
                                        class="icon-small {{ $folder->user_id == auth()->user()->id ? 'bg-primary' : 'bg-secondary' }} mb-4 rounded">
                                        <i class="fas fa-folder"></i>
                                    </div>
                                    </p>
                                    <div class="card-header-toolbar">
                                        <div class="dropdown">
                                            <span class="dropdown-toggle" id="dropdownMenuButton3" data-toggle="dropdown">
                                                <i class="ri-more-2-fill"></i>
                                            </span>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuButton3">
                                                @if ($access['Delete'] == 1)
                                                    <form action="{{ route('folder.destroy', $folder->id) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item" type="submit"><i
                                                                class="ri-delete-bin-6-fill mr-2"></i>Delete</button>
                                                    </form>
                                                @endif
                                                @if ($access['Update'])
                                                    <a class="dropdown-item"
                                                        href="{{ route('folder.edit', $folder->id) }}"><i
                                                            class="ri-pencil-fill mr-2"></i>Edit</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
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
                                    $reportCount = \App\Models\Report::where('folder_id', $folder->id)
                                        ->where('user_id', $folder->user->id)
                                        ->count();
                                @endphp
                                <p class="mb-0"><i class="fas fa-file-archive {{ $folder->user_id == auth()->user()->id ? 'text-primary' : 'text-secondary' }} font-size-20 mr-2"></i>
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
