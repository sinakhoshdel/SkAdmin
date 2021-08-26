@extends('admin.sections.master')
@section('title','Add new Category')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-holder">
                            <h1 class="main-title float-left">Categories</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">Categories</li>
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

                       {{-- @if(isset($result))
                            <div class="alert alert-{{$result['status']}}" role="alert">
                                <p class="alert-heading">{{$result['message']}}</p>
                            </div>
                        @endif--}}

                        <div class="card mb-3">
                            <div class="card-header">
                                <h3><i class="fa fa-sitemap"></i> Add new Category</h3>
                            </div>
                            <!-- end card-header -->
                            <div class="card-body">
                                <div class="card-body">

                                    <form action="{{url('admin/category')}}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="title">Category title (required)</label>
                                                <input id="title" class="form-control" name="title" type="text" placeholder="title" value="{{old('title')}}"/>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Parent Category</label>
                                                <select name="parent_id" class="selectpicker" data-live-search="true" >
                                                    <option value="0">Select parent category</option>
                                                    @foreach($categoryList as $id=>$category)
                                                        <option value="{{$id}}">{{$category}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Active</label>
                                                <div>
                                                    <label class="switch">
                                                        <input type="checkbox" name="active" checked>
                                                        <span class="slider round">
                                                                <span class="on">ON</span>
                                                                <span class="off">OFF</span>
                                                            </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="input-group col-lg-6 mt-2 mb-3">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="image" data-preview="image" class="btn btn-block btn-primary ">
                                                      <i class="fa fa-picture-o"></i> Category Main Image<br><small>(jpeg,jpg,png,gif)</small>
                                                    </a>
                                                </span>
                                                <input id="image" class="form-control" type="text" name="image" style="border-radius: 0 5px 5px 0" value="{{old('image')}}">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Description (optional)</label>
                                                <textarea class="form-control" name="description" rows="4">{{old('description')}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="title">Font Icon </label>
                                                    (Find all Icons <a target="_blank" href="https://fontawesome.com/icons">here</a>)
                                                    ex: <span class="fa fa-2x fa-book"></span> <strong> fa fa-book </strong>
                                                    <input id="icon" class="form-control" name="icon" type="text" placeholder="Font Awesome Icon"/>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Add category</button>
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
