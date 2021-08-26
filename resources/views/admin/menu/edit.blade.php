@extends('admin.sections.master')
@section('title','Add new Menu')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-holder">
                            <h1 class="main-title float-left">Menu Manager</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">Menu Manager</li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        {{--dispaly all error from create new menu form--}}
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
                                <h3><i class="fa fa-sitemap"></i> Update Menu <span class="text-success font-weight-bold"><i class="{{$editMenu->icon}}"></i> {{$editMenu->title}}</span></h3>
                            </div>
                            <!-- end card-header -->
                            <div class="card-body">
                                <div class="card-body">
                                    <form action="{{route('menu.update',$editMenu->id)}}" method="post" enctype="multipart/form-data">
                                        @method('patch')
                                        {{csrf_field()}}
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="title">Menu title (required)</label>
                                                <input id="title" class="form-control" name="title" type="text" placeholder="title" value="{{$editMenu->title}}"/>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="title">Menu Link</label>
                                                <input id="link" class="form-control" name="link" type="text" placeholder="link"  value="{{$editMenu->link}}"/>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Parent Menu</label>
                                                <select name="parent" class="selectpicker" data-live-search="true" >
                                                    <option value="0">Select parent menu</option>
                                                    @foreach($menuList as $id=>$menu)
                                                        <option @if($editMenu->parent===$id) selected="selected" @endif value="{{$id}}">{{$menu}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Menu Type</label>
                                                    <select onchange="showMenuRelation()" name="menuType" class="selectpicker" data-live-search="true">
                                                        @foreach($menuTypes as $t=>$type)
                                                            <option  @if($editMenu->type===$t) selected="selected" @endif value="{{$t}}">{{$type}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="categoryList" style="display: none">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Select Category</label>
                                                    <select name="category" class="selectpicker" data-live-search="true">
                                                        <option  @if($editMenu->category==='all') selected="selected" @endif value="all">All Categories</option>
                                                        @foreach($categoryList as $c=>$category)
                                                            <option  @if($editMenu->category===$category->title) selected="selected" @endif value="{{$category->url}}">{{$category->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" id="galleryList" style="display: none">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label>Select Galley</label>
                                                    <select   @if($editMenu->gallery==='all') selected="selected" @endif name="gallery" class="selectpicker" data-live-search="true">
                                                        <option value="all">All Garlleries</option>
                                                        @foreach($galleryList as $g=>$gallery)
                                                            <option   @if($editMenu->gallery===$gallery->title) selected="selected" @endif value="{{$gallery->title}}">{{$gallery->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Active</label>
                                                <div>
                                                    <label class="switch">
                                                        <input type="checkbox" name="active" @if($editMenu->active==1) checked @endif>
                                                        <span class="slider round">
                                                            <span class="on">ON</span>
                                                            <span class="off">OFF</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="title">Font Icon </label>
                                                (Find all Icons <a target="_blank" href="https://fontawesome.com/icons">here</a>) ex:  <span class="fa fa-2x fa-book"></span> <strong> fa fa-book </strong>
                                                <input id="icon" class="form-control" name="icon" type="text" placeholder="Font Awesome Icon"  value="{{$editMenu->icon}}"/>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Menu</button>
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
        $(document).ready(function () {
            showMenuRelation();
        });
        function showMenuRelation() {
            var val = $('select[name=menuType]').val();
            if(val == 'content') {
                $('#categoryList').css('display', 'none');
                $('#galleryList').css('display', 'none');
            }else if(val=='category'){
                $('#categoryList').css('display', 'block');
                $('#galleryList').css('display','none');
            }else if(val=='gallery'){
                $('#categoryList').css('display', 'none');
                $('#galleryList').css('display','block');
            }else{
                $('#categoryList').css('display', 'none');
                $('#galleryList').css('display', 'none');
            }
        }
    </script>
@endsection