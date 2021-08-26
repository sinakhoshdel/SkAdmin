@extends('admin.sections.master')
@section('title','Galleries')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-holder">
                            <h1 class="main-title float-left"><i class="fa fa-file-image-o"></i> Image Gallery Manager</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">Gallery Manager</li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-md-12">
                        <div id="displayErrors">
                            {{--dispaly all error from create new Gallery form--}}
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

                        </div>
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-2 topButton">
                                        <button class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#modal_add_gallery">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Add new Gallery
                                        </button>
                                    </div>
                                    <div class="col-xs-6 col-md-2 topButton">
                                        <button class="btn btn-danger btn-sm btn-block" data-toggle="modal"
                                                data-target=".bulk_remove_form">
                                            <i class="fa fa-trash" aria-hidden="true"></i> Remove Item(s)
                                        </button>
                                    </div>
                                </div>
                                {{--add new gallery modal box--}}
                                <div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true"
                                     id="modal_add_gallery">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{url('admin/gallery')}}" method="post"
                                                  enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add new Gallery</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span
                                                                aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>Gallery title (required)</label>
                                                                <input class="form-control" name="title" type="text"/>
                                                            </div>
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

                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>Description (optional)</label>
                                                                <textarea class="form-control" name="description"
                                                                          rows="4"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Add Gallery</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end card-header -->
                            <div class="card-body table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 70px">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" class="custom-control-input" id="defaultChecked"  >
                                                <label class="custom-control-label" for="defaultChecked"></label>
                                            </div>
                                        </th>
                                        <th>Gallery Name</th>
                                        <th class="hidden-mobile text-center">Create at</th>
                                        <th class="hidden-mobile text-center">Last Update</th>
                                        <th class="hidden-mobile text-center">Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($allGalleries) && sizeof($allGalleries)>0)
                                        @foreach($allGalleries as $index=>$gallery)
                                            <tr>
                                                <td>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" name="selected[]" value="{{$gallery->id}}" class="custom-control-input" id="defaultChecked{{$gallery->id}}"  >
                                                        <label class="custom-control-label" for="defaultChecked{{$gallery->id}}"></label>
                                                    </div>
                                                <td>
                                                    <strong>{{$gallery->title}}</strong><br/>
                                                </td>
                                                <td class="hidden-mobile text-center">{{$gallery->created_at->format('Y.m.d H:ia')}}</td>
                                                <td class="hidden-mobile text-center">{{$gallery->updated_at->format('Y.m.d H:ia')}}</td>
                                                <td class="hidden-mobile text-center">
                                                    <label class="switch">
                                                        <input type="checkbox" name="active" @if($gallery->active==1) checked @endif onclick="galleryStatus('{{$gallery->id}}','{{$gallery->active}}')">
                                                        <span class="slider round">
                                                            <span class="on">ON</span>
                                                            <span class="off">OFF</span>
                                                        </span>
                                                    </label>
                                                </td>
                                                <td class="text-center">
                                                    <a title="Edit"
                                                       href="{{url('/admin/gallery/'.$gallery->id.'/edit')}}"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>
                                                    <a title="Manage images"
                                                       href="{{url('/admin/gallery/'.$gallery->id.'/addGalleryImages')}}"
                                                       class="hidden-mobile btn btn-dark btn-sm">
                                                        <i class="fa fa-image" aria-hidden="true"></i>
                                                    </a>
                                                    <a title="Remove" role="button" href="#"
                                                       class="btn btn-danger btn-sm" data-toggle="modal"
                                                       data-target=".delete-gallery-{{$gallery->id}}">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <!--Modal window for delete -->
                                            <div class="modal fade delete-gallery-{{$gallery->id}}" tabindex="-1"
                                                 role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-md">
                                                    <div class="modal-content">
                                                        <form action="{{route('gallery.destroy',$gallery->id)}}"
                                                              method="post">
                                                            @method('delete')
                                                            {{csrf_field()}}
                                                            <div class="modal-header bg-danger">
                                                                <h5 class="modal-title">Warning</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Are you sure that you want to permanently delete the
                                                                selected item?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Delete
                                                                </button>
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <tr class="text-center">
                                            <td colspan="6"><img alt="No Data Found!" class="img-fluid"
                                                                 src="{{url("files/shares/icons/no_data_found.png")}}"
                                                                 alt="No Record Found"></td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            {{$allGalleries->appends(request()->input())->links()}}


                            <!--Modal window for bulk delete -->
                                <div class="bulk_remove_form modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title">Warning</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure that you want to permanently delete the selected item(s)?
                                                <strong>Notice!</strong> All of related Sub Galleries will be deleted.
                                            </div>
                                            <div class="modal-footer">
                                                <button onclick="bulkRemoveGallery()" class="btn btn-danger">Delete
                                                </button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
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
    <!-- Large modal -->
@endsection
@section('scripts')
    <script>
        function galleryStatus(id, status) {
            if (status === '1') {
                var newStatus = 0;
            } else {
                var newStatus = 1;
            }

            $.ajax({
                url: "gallery/refreshGalleryStatus",
                type: 'POST',
                data: {id: id, active: newStatus},
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', '@php echo csrf_token(); @endphp');
                },
                success: function (response) {
                    if (response.status == 'success') {
                        //$('#refreshStatusMsg').html('<span class="text-success"><i class="fa fa-thumbs-up"></i><strong> Updated!</strong></span>');
                    } else {
                        $('#refreshStatusMsg').html('<span class="text-danger"><i class="fa fa-thumbs-down"></i><strong> Error!</strong></span>');
                    }
                    setTimeout(function () {
                        $('#refreshStatusMsg span').remove();
                    }, 1000);
                }
            });
        }

        function bulkRemoveGallery() {
            var selected = new Array();
            $('input[name*=\'selected\']:checked').each(function () {
                selected.push($(this).val());
            });
            if (selected.length > 0) {
                $.ajax({
                    url: "gallery/bulkRemove",
                    type: 'POST',
                    data: {selected: selected},
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', '@php echo csrf_token(); @endphp');
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            location.reload();
                        } else {
                            $('.modal-backdrop').hide();
                            $(".bulk_remove_form").hide();
                            $('#displayErrors').html(
                                '<div class="alert alert-danger" role="alert">\n' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                                '<h4 class="alert-heading">Something went wrong. Please try again!</h4>\n' +
                                '</div>');
                        }
                    }
                });
            } else {
                $('.modal-backdrop').hide();
                $('.bulk_remove_form ').hide();
                $('#displayErrors').html(
                    '<div class="alert alert-danger" role="alert">\n' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                    '<h6 class="alert-heading"><i class="fa fa-warning"></i> ' +
                    'Please select at least one Gallery!</h6>\n' +
                    '</div>');
                setTimeout(function () {
                    $('#displayErrors div.alert').fadeOut();
                }, 3000);
            }
        }

    </script>
@endsection