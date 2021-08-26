@extends('admin.sections.master')
@section('title','Contents')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-holder">
                            <h1 class="main-title float-left"><i class="fa fa-folder-open-o"></i> Content Manager</h1>
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
                    <div class="col-md-12">
                        <div id="displayErrors">
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
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="row">
                                    <div class="hidden-mobile col-md-8">
                                        <div class="col-md-6">
                                            {{--<div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fa fa-search"></i>
                                                    </div>
                                                </div>
                                                <form action="{{url('admin/category/search')}}" method="get">
                                                    <input type="text" name="search_category" class="form-control" placeholder="Search Content...">
                                                </form>
                                            </div>--}}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-2 topButton">
                                        <a href="content/create" class="btn btn-success btn-sm btn-block">
                                            <i class="fa fa-plus"></i> Add new content
                                        </a>
                                    </div>
                                    <div class="col-xs-6 col-md-2 topButton">
                                        <button class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target=".bulk_remove_form">
                                            <i class="fa fa-trash" aria-hidden="true"></i> Remove Item(s)
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-header -->
                            <div class="card-body table-responsdefaultCheckedive">
                                <table class="table table-hover table-striped" id="admin-content-table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" class="custom-control-input" id="defaultChecked"  >
                                                <label class="custom-control-label" for="defaultChecked"></label>
                                            </div>
                                        </th>
                                        <th><span class="hidden-mobile">Content</span> Title</th>
                                        <th class="hidden-mobile text-center">Category</th>
                                        <th class="hidden-mobile text-center">Last Updated</th>
                                        <th class="text-center" style="width:120px">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($allContents)>0)
                                            @foreach($allContents as $index=>$content)
                                                <tr>
                                                    <td>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="selected[]" value="{{$content->id}}" class="custom-control-input" id="defaultChecked{{$content->id}}"  >
                                                            <label class="custom-control-label" for="defaultChecked{{$content->id}}"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <strong>{{$content->title}}</strong><br/>
                                                        <small class="hidden-mobile">{{$content->metaDescription}}</small>
                                                        <div class="d-block d-sm-none">
                                                            <strong>Category: </strong>
                                                            <small>{{($content->getCategoryName->title !==0) ? $content->getCategoryName->title :'unassigned'}}</small>
                                                        </div>
                                                    </td>
                                                    <td class="hidden-mobile text-center">
                                                        {{($content->getCategoryName->title !==0) ? $content->getCategoryName->title :'unassigned'}}
                                                    </td>
                                                    <td class="hidden-mobile text-center">
                                                        {{$content->updated_at->format('Y.m.d H:i a')}}
                                                    </td>
                                                    <td class="text-center">
                                                        <a title="Edit" href="{{url('/admin/content/'.$content->id.'/edit')}}" class="btn btn-primary btn-sm">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                                        </a>
                                                        <a title="Remove" data-id="{{$content->id}}"
                                                           class="removeContent btn btn-danger btn-sm del-button text-white">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <!--Modal window for delete -->
                                                <div class="modal fade delete-cat-{{$content->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-md">
                                                        <div class="modal-content">
                                                            <form action="{{route('content.destroy',$content->id)}}" method="post">
                                                                @method('delete')
                                                                {{csrf_field()}}
                                                                <div class="modal-header bg-danger">
                                                                    <h5 class="modal-title">Warning</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure that you want to permanently delete the selected item?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <tr class="text-center">
                                                <td colspan="6"><img class="img-fluid" src="{{url("files/shares/icons/no_data_found.png")}}" alt="No Record Found"></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {{$allContents->appends(request()->input())->links()}}

                                {{--modal for remove category--}}
                                <div class="modal fade" id="removeContentItem">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title">Warning</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body bg-white">
                                                <p>Are you sure that you want to permanently delete the selected item?</p>
                                                <input type="hidden" name="contentId" id="contentId" value=""/>
                                            </div>
                                            <div class="modal-footer bg-white">
                                                <button onclick="deleteContent()" class="btn btn-danger">Delete</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Modal window for bulk delete -->
                                <div class="bulk_remove_form modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title">Warning</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure that you want to permanently delete the selected item(s)?
                                            </div>
                                            <div class="modal-footer">
                                                <button onclick="bulkRemoveContent()" class="btn btn-danger">Delete</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    <!-- modals for delete-->
    <!-- Large modal -->

@endsection
@section('scripts')
<script>
    function bulkRemoveContent() {
        var selected = new Array();
        $('input[name*=\'selected\']:checked').each(function() {
            selected.push($(this).val());
        });
        if(selected.length>0){
            $.ajax({
                url: "content/bulkRemove",
                type: 'POST',
                data : {selected:selected},
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', '@php echo csrf_token(); @endphp');
                },
                success: function(response) {
                    if(response.status == 'success'){
                        location.reload();
                    }else{
                        $(".modal-backdrop").hide();
                        $('#displayErrors').html(
                            '<div class="alert alert-danger" role="alert">\n' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                                '<h4 class="alert-heading">Something went wrong. Please try again!</h4>\n' +
                            '</div>');
                    }
                }
            });
        }else{
            $('.modal-backdrop').hide();
            $('.bulk_remove_form ').hide();
            $('#displayErrors').html(
                '<div class="alert alert-danger" role="alert">\n' +
                '<button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                '<h6 class="alert-heading"><i class="fa fa-warning"></i> ' +
                'Please select at least one content!</h6>\n' +
                '</div>');
            setTimeout(function() {
                $('#displayErrors div.alert').fadeOut();
            }, 3000);
        }
    }

    $(document).on("click", ".removeContent", function () {
        var contentId = $(this).data('id');
        $("#removeContentItem #contentId").val(contentId);
        $('#removeContentItem').modal('show');
    });

    function deleteContent() {
        var id = $('input#contentId').val();
        var deleteForm = '<form method="post" action="content/destroy">' +
            '<input name="id" value="' + id + '"/>' +
            '<input name="_method" value="delete"/>' +
            '<input name="_token" value="{{csrf_token()}}"/>' +
            '</form>';
        $(deleteForm).appendTo('body').submit();
    }

    $(document).ready(function() {
        $('#admin-content-table').DataTable();
    } );
</script>
@endsection