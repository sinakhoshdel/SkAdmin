@extends('admin.sections.master')
@section('title','Update new Category')
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
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h3><i class="fa fa-sitemap"></i> Update Category : <span class="text-success font-weight-bold">{{$editCategory->title}}</span></h3>
                                    </div>
                                    <div class="col-xs-6 col-md-2 topButton">
                                        <a href="{{url('admin/category')}}" class="btn btn-success btn-sm btn-block">
                                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-header -->
                            <div class="card-body">
                                <div class="card-body">
                                    <form action="{{route('category.update',$editCategory->id)}}" method="post" enctype="multipart/form-data">
                                        @method('patch')
                                        {{csrf_field()}}
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="title">Category title (required)</label>
                                                <input id="title" class="form-control" name="title" type="text" placeholder="title" value="{{$editCategory->title}}"/>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Parent Category</label>
                                                <select name="parent_id" class="selectpicker" data-live-search="true" >
                                                    <option value="0">Select parent category</option>
                                                    @foreach($categoryList as $id=>$category)
                                                        <option @if($editCategory->id===$id || in_array($id,$getChildrenCategories)) disabled="disabled" @endif @if($editCategory->parent_id===$id) selected @endif value="{{$id}}">{{$category}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Active</label>
                                                <div>
                                                    <label class="switch">
                                                        <input type="checkbox" name="active" @if($editCategory->active==1) checked @endif>
                                                        <span class="slider round">
                                                                <span class="on">ON</span>
                                                                <span class="off">OFF</span>
                                                            </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="input-group col-lg-3 mt-2 mb-3">
                                                <span class="input-group-btn">
                                                    <a id="lfm" data-input="image" data-preview="image" class="btn btn-block btn-primary ">
                                                      <i class="fa fa-picture-o"></i> Category Main Image
                                                    </a>
                                                </span>
                                                <input id="catImage" class="form-control" type="hidden" name="image" value="{{$editCategory->image}}">
                                            </div>
                                            <span style="cursor: pointer" id="removeCatImgSpan" class="fa fa-remove text-danger" onclick="removeCatImg()"></span>
                                            <div id="showCatImg" class="input-group col-lg-1 mt-2 mb-3">
                                                <img src="{{url($editCategory->image)}}" alt="{{$editCategory->title}}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Description (optional)</label>
                                                <textarea class="form-control" name="description" rows="4">{{$editCategory->description}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="title">Font Icon </label>
                                                    (Find all Icons <a target="_blank" href="https://fontawesome.com/icons">here</a>)
                                                    ex: <span class="fa fa-2x fa-book"></span> <strong> fa fa-book </strong>
                                                    <input value="{{$editCategory->icon}}" id="icon" class="form-control" name="icon" type="text" placeholder="Font Awesome Icon"/>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update category</button>
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
    <script>
        function removeCatImg(){
            $('input#catImage').val('');
            $('#showCatImg').slideUp();
            $('#removeCatImgSpan').slideUp();
        }
    </script>
@endsection