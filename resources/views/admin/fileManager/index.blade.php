@extends('admin.sections.master')
@section('title','File Manager')

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-holder">
                            <h1 class="main-title float-left"><i class="fa fa-file-text"></i> File Manager</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">File Manager</li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 awesome-file-manager">
                        <iframe src="{{url('/laravel-fileManager')}}" style="width: 100%; height: 600px; overflow: hidden; border: none;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
