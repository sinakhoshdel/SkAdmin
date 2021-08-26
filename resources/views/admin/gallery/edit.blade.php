@extends('admin.sections.master')
@section('title','Add new Galley')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.css" />
@endsection
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-holder">
                            <h1 class="main-title float-left">Galleries</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">Galleries</li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        {{--dispaly all error from create new category form--}}
                        @if($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <h4 class="alert-heading">Please check following Erros:</h4>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3><i class="fa fa-sitemap"></i> Update Gallery : <span class="text-success font-weight-bold">{{$editGallery->title}}</span></h3>
                            </div>
                            <!-- end card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <form action="{{route('gallery.update',$editGallery->id)}}" method="post" enctype="multipart/form-data">
                                            @method('patch')
                                            {{csrf_field()}}
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="title">Gallery title (required)</label>
                                                    <input id="title" class="form-control" name="title" type="text" placeholder="title" value="{{$editGallery->title}}"/>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label>Description (optional)</label>
                                                    <textarea class="form-control" name="description" rows="4" placeholder="Description...">{{$editGallery->description}}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label>Active</label>
                                                    <div>
                                                        <label class="switch">
                                                            <input type="checkbox" name="active" @if($editGallery->active==1) checked @endif>
                                                            <span class="slider round">
                                                            <span class="on">ON</span>
                                                            <span class="off">OFF</span>
                                                        </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Update Gallery</button>
                                        </form>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="title">Gallery Images</label>
                                        <a href="{{url('/admin/gallery/'.$editGallery->id.'/addGalleryImages')}}" class="btn btn-sm btn-success pull-right">Manage Images</a>
                                        <hr>
                                        <div class="row">
                                            @foreach($editGallery->getImages as $key=>$value)
                                                <div class="col-md-3">
                                                    <a data-fancybox="gallery" href="{{url($value->path)}}" class="col-sm-2">
                                                        <img alt="{{$value->name}}" src="{{url($value->path)}}" class="img-fluid">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end card-body -->

                        </div>
                        <!-- end card -->

                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->


            </div>
            <!-- END container-fluid -->

        </div>
        <!-- END content -->

    </div>
    <!-- END content-page -->

@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
@endsection