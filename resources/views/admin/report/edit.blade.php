@extends('admin.layouts.app')

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
                            @include('admin.report._form',[
                                'action' => route('report.update',$report->id),
                                'formMethod' => 'PUT',
                                'routeBack' => route('report.index'),
                                'report' => $report
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
