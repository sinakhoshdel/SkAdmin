@extends('admin.sections.master')
@section('title','Add Galley Images')
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
                                <div class="row">
                                    <div class="col-md-8">
                                        <h3><i class="fa fa-sitemap"></i> Add Images to Gallery : <span class="text-success font-weight-bold"><a href="{{url('admin/gallery/'.$editGallery->id.'/addGalleryImages')}}">{{$editGallery->title}}</a></span></h3>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{url('admin/gallery')}}" class="pull-right btn btn-success btn-sm">
                                            <i class="fa fa-image"></i> All galleries
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center" id="refreshStatusMsg"></div>
                            </div>
                            <!-- end card-header -->
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($editGallery->getImages as $key=>$value)
                                            <div class="col-md-2" id="image-{{$value->id}}">
                                                <a data-fancybox="gallery" href="{{url($value->path)}}" class="col-sm-2">
                                                    <img alt="{{$value->name}}" src="{{url($value->path)}}" class="img-fluid">
                                                </a>
                                                <span onclick="removeImage({{$value->id}})" class="removeImageGallery"><i class="fa fa-remove"></i></span>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <label>Upload your images here</label>
                                    <form action="{{route('uploadImage',$editGallery->id)}}" method="post" class="dropzone" id="addImages">
                                        {{csrf_field()}}
                                        <input type="hidden" name="gallery_name" value="{{$editGallery->title}}">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">

                                            </div>
                                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.2.5/jquery.fancybox.min.js"></script>
    <script>
        function removeImage(id){
            var imgDiv = '#image-'+id;
            console.log(imgDiv);
            $.ajax({
                url: "{{url('admin/gallery/removeImage')}}",
                type: 'POST',
                data : {id:id},
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', '@php echo csrf_token(); @endphp');
                },
                success: function(response) {
                    if(response.status == 'success'){
                        $('#refreshStatusMsg').html('<span class="text-success"><br><i class="fa fa-thumbs-up"></i><strong> Removed!</strong></span>');
                        $(imgDiv).remove();
                    }else{
                        $('#refreshStatusMsg').html('<span class="text-danger"><i class="fa fa-thumbs-down"></i><strong> Error!</strong></span>');
                    }
                    setTimeout(function() {
                        $('#refreshStatusMsg span').remove();
                    }, 1000);
                }
            });
        }
    </script>
@endsection