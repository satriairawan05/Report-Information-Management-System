@extends('admin.layouts.app')

@push('loader')
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
@endpush

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
@endpush

@section('main')
    <div class="content-page">
        <div class="container-fluid">
            {{-- File --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex align-items-center justify-content-between welcome-content mb-3">
                        <h4>All Files</h4>
                        <div class="d-flex align-items-center">
                            <div class="list-grid-toggle mr-4">
                                <span class="icon icon-grid i-grid"><i class="ri-layout-grid-line font-size-20"></i></span>
                                <span class="icon icon-grid i-list"><i class="ri-list-check font-size-20"></i></span>
                                <span class="label label-list">List</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="icon icon-grid i-grid">
                <div class="row">
                    @foreach ($reports as $report)
                        @if ($report->extension == 'doc' || $report->extension == 'docx')
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body image-thumb">
                                        <div class="iq-thumb mb-4 rounded p-3 text-center">
                                            <div class="iq-image-overlay"></div>
                                            <a href="{{ asset('storage/' . $report->documentation) }}"
                                                data-title="{{ $report->original_name }}" data-load-file="file"
                                                data-load-target="#resolte-contaniner"
                                                data-url="{{ asset('storage/' . $report->documentation) }}"
                                                data-toggle="modal" data-target="#exampleModal"><img
                                                    src="{{ asset('cloudbox/assets/images/layouts/page-7/doc.png') }}"
                                                    class="img-fluid" alt="{{ $report->original_name }}"></a>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h6 class="mr-2">{{ $report->original_name }}</h6>
                                            @if ($access['Update'] == 1 && $report->user_id == auth()->user()->id)
                                                <a href="{{ route('report.edit', ['report' => $report->id, 'folder_id' => request()->input('folder_id')]) }}"
                                                    class="btn btn-sm btn-secondary text-gray-dark mr-2"><i
                                                        class="fas fa-edit"></i></a>
                                            @endif
                                            <a href="{{ route('report.download', $report->id) }}"
                                                class="btn btn-sm btn-success text-gray-dark mr-2"><i
                                                    class="fas fa-download"></i></a>
                                            @if ($access['Delete'] == 1 && $report->user_id == auth()->user()->id)
                                                <form action="{{ route('report.destroy', $report->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-primary text-gray-dark"><i
                                                            class="fas fa-trash-can"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($report->extension == 'xls' || $report->extension == 'xlsx')
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body image-thumb">
                                        <div class="iq-thumb mb-4 rounded p-3 text-center">
                                            <div class="iq-image-overlay"></div>
                                            <a href="{{ asset('storage/' . $report->documentation) }}"
                                                data-title="{{ $report->original_name }}" data-load-file="file"
                                                data-load-target="#resolte-contaniner"
                                                data-url="{{ asset('storage/' . $report->documentation) }}"
                                                data-toggle="modal" data-target="#exampleModal"><img
                                                    src="{{ asset('cloudbox/assets/images/layouts/page-7/xlsx.png') }}"
                                                    class="img-fluid" alt="{{ $report->original_name }}"></a>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h6 class="mr-2">{{ $report->original_name }}</h6>
                                            @if ($access['Update'] == 1 && $report->user_id == auth()->user()->id)
                                                <a href="{{ route('report.edit', ['report' => $report->id, 'folder_id' => request()->input('folder_id')]) }}"
                                                    class="btn btn-sm btn-secondary text-gray-dark mr-2"><i
                                                        class="fas fa-edit"></i></a>
                                            @endif
                                            <a href="{{ route('report.download', $report->id) }}"
                                                class="btn btn-sm btn-success text-gray-dark mr-2"><i
                                                    class="fas fa-download"></i></a>
                                            @if ($access['Delete'] == 1 && $report->user_id == auth()->user()->id)
                                                <form action="{{ route('report.destroy', $report->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-primary text-gray-dark"><i
                                                            class="fas fa-trash-can"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($report->extension == 'ppt' || $report->extension == 'pptx')
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body image-thumb">
                                        <div class="iq-thumb mb-4 rounded p-3 text-center">
                                            <div class="iq-image-overlay"></div>
                                            <a href="{{ asset('storage/' . $report->documentation) }}"
                                                data-title="{{ $report->original_name }}" data-load-file="file"
                                                data-load-target="#resolte-contaniner"
                                                data-url="{{ asset('storage/' . $report->documentation) }}"
                                                data-toggle="modal" data-target="#exampleModal"><img
                                                    src="{{ asset('cloudbox/assets/images/layouts/page-7/ppt.png') }}"
                                                    class="img-fluid" alt="{{ $report->original_name }}"></a>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h6 class="mr-2">{{ $report->original_name }}</h6>
                                            @if ($access['Update'] == 1 && $report->user_id == auth()->user()->id)
                                                <a href="{{ route('report.edit', ['report' => $report->id, 'folder_id' => request()->input('folder_id')]) }}"
                                                    class="btn btn-sm btn-secondary text-gray-dark mr-2"><i
                                                        class="fas fa-edit"></i></a>
                                            @endif
                                            <a href="{{ route('report.download', $report->id) }}"
                                                class="btn btn-sm btn-success text-gray-dark mr-2"><i
                                                    class="fas fa-download"></i></a>
                                            @if ($access['Delete'] == 1 && $report->user_id == auth()->user()->id)
                                                <form action="{{ route('report.destroy', $report->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary text-gray-dark"><i
                                                            class="fas fa-trash-can"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($report->extension == 'pdf')
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body image-thumb">
                                        <div class="iq-thumb mb-4 rounded p-3 text-center">
                                            <div class="iq-image-overlay"></div>
                                            <a href="{{ asset('storage/' . $report->documentation) }}"
                                                data-title="{{ $report->original_name }}" data-load-file="file"
                                                data-load-target="#resolte-contaniner"
                                                data-url="{{ asset('storage/' . $report->documentation) }}"
                                                data-toggle="modal" data-target="#exampleModal"><img
                                                    src="{{ asset('cloudbox/assets/images/layouts/page-7/pdf.png') }}"
                                                    class="img-fluid" alt="{{ $report->original_name }}"></a>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h6 class="mr-2">{{ $report->original_name }}</h6>
                                            @if ($access['Update'] == 1 && $report->user_id == auth()->user()->id)
                                                <a href="{{ route('report.edit', ['report' => $report->id, 'folder_id' => request()->input('folder_id')]) }}"
                                                    class="btn btn-sm btn-secondary text-gray-dark mr-2"><i
                                                        class="fas fa-edit"></i></a>
                                            @endif
                                            <a href="{{ route('report.download', $report->id) }}"
                                                class="btn btn-sm btn-success text-gray-dark mr-2"><i
                                                    class="fas fa-download"></i></a>
                                            @if ($access['Delete'] == 1 && $report->user_id == auth()->user()->id)
                                                <form action="{{ route('report.destroy', $report->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary text-gray-dark"><i
                                                            class="fas fa-trash-can"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($report->extension == 'jpg' || $report->extension == 'jpeg' || $report->extension == 'png')
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body image-thumb">
                                        <div class="iq-thumb mb-4 rounded p-3 text-center">
                                            <div class="iq-image-overlay"></div>
                                            <a href="{{ asset('storage/' . $report->documentation) }}"
                                                data-title="{{ $report->original_name }}" data-load-file="file"
                                                data-load-target="#resolte-contaniner"
                                                data-url="{{ asset('storage/' . $report->documentation) }}"
                                                data-toggle="modal" data-target="#exampleModal"><img
                                                    src="{{ asset('cloudbox/assets/images/layouts/page-7/jpg.png') }}"
                                                    class="img-fluid" alt="{{ $report->original_name }}"></a>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <h6 class="mr-2">{{ $report->original_name }}</h6>
                                            @if ($access['Update'] == 1 && $report->user_id == auth()->user()->id)
                                                <a href="{{ route('report.edit', ['report' => $report->id, 'folder_id' => request()->input('folder_id')]) }}"
                                                    class="btn btn-sm btn-secondary text-gray-dark mr-2"><i
                                                        class="fas fa-edit"></i></a>
                                            @endif
                                            <a href="{{ route('report.download', $report->id) }}"
                                                class="btn btn-sm btn-success text-gray-dark mr-2"><i
                                                    class="fas fa-download"></i></a>
                                            @if ($access['Delete'] == 1 && $report->user_id == auth()->user()->id)
                                                <form action="{{ route('report.destroy', $report->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-sm btn-primary text-gray-dark"><i
                                                            class="fas fa-trash-can"></i></button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="icon icon-grid i-list">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-borderless tbl-server-info mb-0 table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Owner</th>
                                                <th scope="col">Last Edit</th>
                                                <th scope="col">File Size</th>
                                                @if ($access['Update'] == 1 || $access['Delete'] == 1)
                                                    <th scope="col"></th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reports as $report)
                                                @if ($report->extension == 'pdf')
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="icon-small bg-danger mr-3 rounded">
                                                                    <i class="fas fa-file-pdf"></i>
                                                                </div>
                                                                <div data-title="{{ $report->original_name }}"
                                                                    data-load-file="file"
                                                                    data-load-target="#resolte-contaniner"
                                                                    data-url="{{ asset('storage/' . $report->documentation) }}"
                                                                    data-toggle="modal" data-target="#exampleModal"
                                                                    style="cursor: pointer;">{{ $report->original_name }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $report->user_id == auth()->user()->id ? 'Me' : $report->user->name }}
                                                        </td>
                                                        <td>{{ $report->updated_at->format('M d, Y') }}</td>
                                                        <td>{{ ceil($report->size / 1024) }} {{ ceil($report->size / 1024) > 1024 ? 'MB' : 'KB' }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <span class="dropdown-toggle" id="dropdownMenuButton10"
                                                                    data-toggle="dropdown">
                                                                    <i class="ri-more-fill"></i>
                                                                </span>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton10">
                                                                    @if ($access['Delete'] == 1 && $report->user_id == auth()->user()->id)
                                                                        <form
                                                                            action="{{ route('report.destroy', $report->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="dropdown-item"><i
                                                                                    class="ri-delete-bin-6-fill mr-2"></i>Delete</button>
                                                                        </form>
                                                                    @endif
                                                                    @if ($access['Update'] == 1 && $report->user_id == auth()->user()->id)
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('report.edit', $report->id) }}"><i
                                                                                class="ri-pencil-fill mr-2"></i>Edit</a>
                                                                    @endif
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('report.download', $report->id) }}"><i
                                                                            class="ri-file-download-fill mr-2"></i>Download</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($report->extension == 'doc' || $report->extension == 'docx')
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="icon-small bg-primary mr-3 rounded">
                                                                    <i class="ri-file-download-line"></i>
                                                                </div>
                                                                <div data-title="{{ $report->original_name }}"
                                                                    data-load-file="file"
                                                                    data-load-target="#resolte-contaniner"
                                                                    data-url="{{ asset('storage/' . $report->documentation) }}"
                                                                    data-toggle="modal" data-target="#exampleModal"
                                                                    style="cursor: pointer;">{{ $report->original_name }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $report->user_id == auth()->user()->id ? 'Me' : $report->user->name }}
                                                        </td>
                                                        <td>{{ $report->updated_at->format('M d, Y') }}</td>
                                                        <td>{{ ceil($report->size / 1024) }} {{ ceil($report->size / 1024) > 1024 ? 'MB' : 'KB' }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <span class="dropdown-toggle" id="dropdownMenuButton11"
                                                                    data-toggle="dropdown">
                                                                    <i class="ri-more-fill"></i>
                                                                </span>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton11">
                                                                    @if ($access['Delete'] == 1 && $report->user_id == auth()->user()->id)
                                                                        <form
                                                                            action="{{ route('report.destroy', $report->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="dropdown-item"><i
                                                                                    class="ri-delete-bin-6-fill mr-2"></i>Delete</button>
                                                                        </form>
                                                                    @endif
                                                                    @if ($access['Update'] == 1 && $report->user_id == auth()->user()->id)
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('report.edit', $report->id) }}"><i
                                                                                class="ri-pencil-fill mr-2"></i>Edit</a>Download</a>
                                                                    @endif
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('report.download', $report->id) }}"><i
                                                                            class="ri-file-download-fill mr-2"></i>Download</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($report->extension == 'xls' || $report->extension == 'xlsx')
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="icon-small bg-success mr-3 rounded">
                                                                    <i class="fas fa-file-excel"></i>
                                                                </div>
                                                                <div data-title="{{ $report->original_name }}"
                                                                    data-load-file="file"
                                                                    data-load-target="#resolte-contaniner"
                                                                    data-url="{{ asset('storage/' . $report->documentation) }}"
                                                                    data-toggle="modal" data-target="#exampleModal"
                                                                    style="cursor: pointer;">{{ $report->original_name }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $report->user_id == auth()->user()->id ? 'Me' : $report->user->name }}
                                                        </td>
                                                        <td>{{ $report->updated_at->format('M d, Y') }}</td>
                                                        <td>{{ ceil($report->size / 1024) }} {{ ceil($report->size / 1024) > 1024 ? 'MB' : 'KB' }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <span class="dropdown-toggle" id="dropdownMenuButton13"
                                                                    data-toggle="dropdown">
                                                                    <i class="ri-more-fill"></i>
                                                                </span>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton13">
                                                                    @if ($access['Delete'] == 1 && $report->user_id == auth()->user()->id)
                                                                        <form
                                                                            action="{{ route('report.destroy', $report->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="dropdown-item"><i
                                                                                    class="ri-delete-bin-6-fill mr-2"></i>Delete</button>
                                                                        </form>
                                                                    @endif
                                                                    @if ($access['Update'] == 1 && $report->user_id == auth()->user()->id)
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('report.edit', $report->id) }}"><i
                                                                                class="ri-pencil-fill mr-2"></i>Edit</a>
                                                                    @endif
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('report.download', $report->id) }}"><i
                                                                            class="ri-file-download-fill mr-2"></i>Download</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($report->extension == 'ppt' || $report->extension == 'pptx')
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="icon-small bg-warning mr-3 rounded">
                                                                    <i class="fas fa-file-powerpoint"></i>
                                                                </div>
                                                                <div data-title="{{ $report->original_name }}"
                                                                    data-load-file="file"
                                                                    data-load-target="#resolte-contaniner"
                                                                    data-url="{{ asset('storage/' . $report->documentation) }}"
                                                                    data-toggle="modal" data-target="#exampleModal"
                                                                    style="cursor: pointer;">{{ $report->original_name }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $report->user_id == auth()->user()->id ? 'Me' : $report->user->name }}
                                                        </td>
                                                        <td>{{ $report->updated_at->format('M d, Y') }}</td>
                                                        <td>{{ ceil($report->size / 1024) }} {{ ceil($report->size / 1024) > 1024 ? 'MB' : 'KB' }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <span class="dropdown-toggle" id="dropdownMenuButton12"
                                                                    data-toggle="dropdown">
                                                                    <i class="ri-more-fill"></i>
                                                                </span>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton12">
                                                                    @if ($access['Delete'] == 1 && $report->user_id == auth()->user()->id)
                                                                        <form
                                                                            action="{{ route('report.destroy', $report->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="dropdown-item"><i
                                                                                    class="ri-delete-bin-6-fill mr-2"></i>Delete</button>
                                                                        </form>
                                                                    @endif
                                                                    @if ($access['Update'] == 1 && $report->user_id == auth()->user()->id)
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('report.edit', $report->id) }}"><i
                                                                                class="ri-pencil-fill mr-2"></i>Edit</a>
                                                                    @endif
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('report.download', $report->id) }}"><i
                                                                            class="ri-file-download-fill mr-2"></i>Download</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                                @if ($report->extension == 'jpg' || $report->extension == 'jpeg' || $report->extension == 'png')
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="icon-small bg-primary mr-3 rounded">
                                                                    <i class="fas fa-file-image"></i>
                                                                </div>
                                                                <div data-title="{{ $report->original_name }}"
                                                                    data-load-file="file"
                                                                    data-load-target="#resolte-contaniner"
                                                                    data-url="{{ asset('storage/' . $report->documentation) }}"
                                                                    data-toggle="modal" data-target="#exampleModal"
                                                                    style="cursor: pointer;">{{ $report->original_name }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{ $report->user_id == auth()->user()->id ? 'Me' : $report->user->name }}
                                                        </td>
                                                        <td>{{ $report->updated_at->format('M d, Y') }}</td>
                                                        <td>{{ ceil($report->size / 1024) }} {{ ceil($report->size / 1024) > 1024 ? 'MB' : 'KB' }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <span class="dropdown-toggle" id="dropdownMenuButton10"
                                                                    data-toggle="dropdown">
                                                                    <i class="ri-more-fill"></i>
                                                                </span>
                                                                <div class="dropdown-menu dropdown-menu-right"
                                                                    aria-labelledby="dropdownMenuButton10">
                                                                    @if ($access['Delete'] == 1 && $report->user_id == auth()->user()->id)
                                                                        <form
                                                                            action="{{ route('report.destroy', $report->id) }}"
                                                                            method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="dropdown-item"><i
                                                                                    class="ri-delete-bin-6-fill mr-2"></i>Delete</button>
                                                                        </form>
                                                                    @endif
                                                                    @if ($access['Update'] == 1 && $report->user_id == auth()->user()->id)
                                                                        <a class="dropdown-item"
                                                                            href="{{ route('report.edit', $report->id) }}"><i
                                                                                class="ri-pencil-fill mr-2"></i>Edit</a>
                                                                    @endif
                                                                    <a class="dropdown-item"
                                                                        href="{{ route('report.download', $report->id) }}"><i
                                                                            class="ri-file-download-fill mr-2"></i>Download</a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
