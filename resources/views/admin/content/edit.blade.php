@extends('admin.sections.master')
@section('title','Add new Content')
@section('styles')
    <link href="{{url('css/tagsinput.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-holder">
                            <h1 class="main-title float-left">Content Manager</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">Content Manager</li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        {{--dispaly all error from create new content form--}}
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
                                <h3><i class="fa fa-sitemap"></i> Update Content <span class="text-success font-weight-bold">{{$editContent->title}}</span></h3>
                            </div>
                            <!-- end card-header -->
                            <div class="card-body">
                                <div class="card-body">
                                    <form action="{{route('content.update',$editContent->id)}}" method="post" enctype="multipart/form-data">
                                        @method('patch')
                                        {{csrf_field()}}
                                        <input type="hidden" name="id" value="{{$editContent->id}}"/>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="title">Content title (required)</label>
                                                <input id="title" class="form-control" name="title" type="text" placeholder="title" value="{{$editContent->title}}"/>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Category</label>
                                                <select name="category" class="selectpicker" data-live-search="true" >
                                                    <option value="0">Select category</option>
                                                    @foreach($categoryList as $id=>$category)
                                                        <option @if($editContent->category==$id) selected @endif value="{{$id}}">{{$category}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="tags">Tags(optional)</label>
                                                <input type="text" data-role="tagsinput" name="metaTags"  value="{{$editContent->metaTags}}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Short Description (optional)</label>
                                                <textarea name="metaDescription" class="form-control" maxlength="7000">{{$editContent->metaDescription}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Content</label>
                                                <textarea name="content" class="form-control">{{$editContent->content}}</textarea>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update Content</button>
                                    </form>
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
    <!-- CKEditor init -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/ckeditor.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/ckeditor/4.5.11/adapters/jquery.js"></script>
    <script src="{{url('js/tagsinput.js')}}"></script>
    <script>
        $('textarea[name=content]').ckeditor({
            height: 250,
            allowedContent:true,
            filebrowserImageBrowseUrl: route_prefix + '?type=Files',
            filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: route_prefix + '?type=Files',
            filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
        });
    </script>
@endsection