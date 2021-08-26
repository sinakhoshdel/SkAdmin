@extends('admin.sections.master')
@section('title','Categories')
@section('styles')
    <!-- BEGIN CSS for this page -->
    <link href="{{url('css/menuManagerStyles.css')}}" rel="stylesheet" type="text/css"/>
    <!-- END CSS for this page -->
@endsection

@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-holder">
                            <h1 class="main-title float-left"><i class="fa fa-folder-open-o"></i> Category Manager</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">Category Manager</li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-md-12">
                        <div id="displayErrors">
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
                        </div>

                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="row">
                                    <div class="hidden-mobile col-md-10">
                                        @if(isset($allCategories) && count($allCategories)>0)
                                            <div id="nestable-category" class="hidden-mobile col-sm-6 col-md-8">
                                                <button class="btn btn-sm btn-outline-primary" type="button"
                                                        data-action="expand-all"><i class="fa fa-toggle-down"></i> Expand All
                                                </button>
                                                <button class="btn btn-sm btn-outline-primary" type="button"
                                                        data-action="collapse-all"><i class="fa fa-toggle-up"></i> Collapse All
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-xs-6 col-md-2 topButton">
                                        <button class="btn btn-success btn-sm btn-block" data-toggle="modal"
                                                data-target="#modal_add_category">
                                            <i class="fa fa-plus" aria-hidden="true"></i> Add new category
                                        </button>
                                    </div>
                                </div>
                                {{--add new category modal box--}}
                                <div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true"
                                     id="modal_add_category">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{url('admin/category')}}" method="post"
                                                  enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add new category</h5>
                                                    <button type="button" class="close" data-dismiss="modal"><span
                                                                aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>Category title (required)</label>
                                                                <input class="form-control" name="title" type="text" value="{{old('title')}}"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 form-group">
                                                            <label>Parent Category</label>
                                                            <select name="parent_id" class="selectpicker" data-live-search="true">
                                                                <option value="0">Select parent category</option>
                                                                @foreach($categoryList as $id=>$category)
                                                                    <option value="{{$id}}">{{$category}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
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
                                                        <div class="input-group col-lg-12 mt-2 mb-3">
                                                            <span class="input-group-btn">
                                                                <a id="lfm" data-input="image" data-preview="image" class="btn btn-block btn-primary ">
                                                                  <i class="fa fa-picture-o"></i> Category Main Image
                                                                </a>
                                                            </span>
                                                            <input id="image" class="form-control" type="text" name="image" style="border-radius: 0 5px 5px 0" value="{{old('image')}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <label>Description (optional)</label>
                                                                <textarea class="form-control" name="description" rows="4">{{old('description')}}</textarea>
                                                            </div>
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

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Add category</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-header -->
                            <div class="card-body table-responsive">
                                @if(isset($allCategories) && count($allCategories)>0)
                                    <div class="col-md-12 cf nestable-lists">
                                        <div class="dd" id="nestable">
                                            <ol class="dd-list" id="category-id">
                                                @foreach($allCategories as $key=>$value)
                                                    <li class="dd-item dd3-item" data-id="{{$value->id}}">
                                                        <div class="dd-handle dd3-handle"></div>
                                                        <div class="dd3-content">
                                                        <span id="label_show{{$value->id}}"><i
                                                                    class="{{$value->icon}}"></i> {{$value->title}}</span>
                                                            <span class="span-right">
                                                                <label class="switch">
                                                                    <input type="checkbox" id="togBtn" @if($value->active==1) checked @endif onclick="categoryStatus('{{$value->id}}','{{$value->active}}')">
                                                                    <span class="slider round">
                                                                        <!--ADDED HTML -->
                                                                        <span class="on">ON</span>
                                                                        <span class="off">OFF</span>
                                                                        <!--END-->
                                                                    </span>
                                                                </label>
                                                            <a href="category/{{$value->id}}/edit"
                                                               class="btn btn-primary btn-sm edit-button"
                                                               id="{{$value->id}}" label="{{$value->title}}"
                                                               link="{{$value->url}}"><i class="fa fa-pencil"></i></a>
                                                            <a title="Remove" data-id="{{$value->id}}"
                                                               class="removeCategory btn btn-danger btn-sm del-button text-white"><i
                                                                        class="fa fa-trash"></i></a>
                                                        </span>
                                                        </div>
                                                        @foreach($value->getChildCategory as $k=>$v)
                                                            <ol class="child" id="category-id">
                                                                <li class="dd-item dd3-item" data-id="{{$v->id}}">
                                                                    <div class="dd-handle dd3-handle"></div>
                                                                    <div class="dd3-content">
                                                                    <span id="label_show{{$v->id}}">
                                                                        <i class="{{$v->icon}}"></i> {{$v->title}}
                                                                    </span>
                                                                        <span class="span-right">
                                                                            <label class="switch">
                                                                                <input type="checkbox" id="togBtn" @if($v->active==1) checked @endif onclick="categoryStatus('{{$v->id}}','{{$v->active}}')">
                                                                                <span class="slider round">
                                                                                    <!--ADDED HTML -->
                                                                                    <span class="on">ON</span>
                                                                                    <span class="off">OFF</span>
                                                                                    <!--END-->
                                                                                </span>
                                                                            </label>
                                                                        <a href="category/{{$v->id}}/edit"
                                                                           class="btn btn-primary btn-sm edit-button"
                                                                           id="{{$v->id}}" label="{{$v->title}}"
                                                                           link="{{$v->url}}"><i
                                                                                    class="fa fa-pencil"></i></a>
                                                                        <a title="Remove" data-id="{{$v->id}}"
                                                                           class="removeCategory btn btn-danger btn-sm del-button text-white">
                                                                            <i class="fa fa-trash"></i></a>
                                                                    </span>
                                                                    </div>
                                                                    @foreach($v->getChildCategory as $k1=>$v1)
                                                                        <ol class="child" id="category-id">
                                                                            <li class="dd-item dd3-item"
                                                                                data-id="{{$v1->id}}">
                                                                                <div class="dd-handle dd3-handle"></div>
                                                                                <div class="dd3-content">
                                                                                <span id="label_show{{$v1->id}}"><i
                                                                                            class="{{$v1->icon}}"></i> {{$v1->title}}</span>
                                                                                    <span class="span-right">
                                                                                        <label class="switch">
                                                                                            <input type="checkbox" id="togBtn" @if($v1->active==1) checked @endif onclick="categoryStatus('{{$v1->id}}','{{$v1->active}}')">
                                                                                            <span class="slider round">
                                                                                                <!--ADDED HTML -->
                                                                                                <span class="on">ON</span>
                                                                                                <span class="off">OFF</span>
                                                                                                <!--END-->
                                                                                            </span>
                                                                                        </label>
                                                                                    <a href="category/{{$v1->id}}/edit"
                                                                                       class="btn btn-primary btn-sm edit-button"
                                                                                       id="{{$v1->id}}"
                                                                                       label="{{$v1->title}}"
                                                                                       link="{{$v1->url}}"><i
                                                                                                class="fa fa-pencil"></i></a>
                                                                                    <a title="Remove"
                                                                                       data-id="{{$v1->id}}"
                                                                                       class="removeCategory btn btn-danger btn-sm del-button text-white">
                                                                                        <i class="fa fa-trash"></i></a>
                                                                                </span>
                                                                                </div>
                                                                                @foreach($v1->getChildCategory as $k2=>$v2)
                                                                                    <ol class="child" id="category-id">
                                                                                        <li class="dd-item dd3-item"
                                                                                            data-id="{{$v2->id}}">
                                                                                            <div class="dd-handle dd3-handle"></div>
                                                                                            <div class="dd3-content">
                                                                                            <span id="label_show{{$v2->id}}"><i
                                                                                                        class="{{$v2->icon}}"></i> {{$v2->title}}</span>
                                                                                                <span class="span-right">
                                                                                                    <label class="switch">
                                                                                                        <input type="checkbox" id="togBtn" @if($v2->active==1) checked @endif onclick="categoryStatus('{{$v2->id}}','{{$v2->active}}')">
                                                                                                        <span class="slider round">
                                                                                                            <!--ADDED HTML -->
                                                                                                            <span class="on">ON</span>
                                                                                                            <span class="off">OFF</span>
                                                                                                            <!--END-->
                                                                                                        </span>
                                                                                                    </label>
                                                                                                <a href="category/{{$v2->id}}/edit"
                                                                                                   class="btn btn-primary btn-sm edit-button"
                                                                                                   id="{{$v2->id}}"
                                                                                                   label="{{$v2->title}}"
                                                                                                   link="{{$v2->url}}"><i
                                                                                                            class="fa fa-pencil"></i></a>
                                                                                                <a title="Remove"
                                                                                                   data-id="{{$v2->id}}"
                                                                                                   class="removeCategory btn btn-danger btn-sm del-button text-white">
                                                                                                    <i class="fa fa-trash"></i></a>
                                                                                            </span>
                                                                                            </div>
                                                                                            @foreach($v2->getChildCategory as $k3=>$v3)
                                                                                                <ol class="child"
                                                                                                    id="category-id">
                                                                                                    <li class="dd-item dd3-item"
                                                                                                        data-id="{{$v3->id}}">
                                                                                                        <div class="dd-handle dd3-handle"></div>
                                                                                                        <div class="dd3-content">
                                                                                                        <span id="label_show{{$v3->id}}"><i
                                                                                                                    class="{{$v3->icon}}"></i> {{$v3->title}}</span>
                                                                                                            <span class="span-right">
                                                                                                                <label class="switch">
                                                                                                                    <input type="checkbox" id="togBtn" @if($v3->active==1) checked @endif onclick="categoryStatus('{{$v3->id}}','{{$v3->active}}')">
                                                                                                                    <span class="slider round">
                                                                                                                        <!--ADDED HTML -->
                                                                                                                        <span class="on">ON</span>
                                                                                                                        <span class="off">OFF</span>
                                                                                                                        <!--END-->
                                                                                                                    </span>
                                                                                                                </label>
                                                                                                            <a href="category/{{$v3->id}}/edit"
                                                                                                               class="btn btn-primary btn-sm edit-button"
                                                                                                               id="{{$v3->id}}"
                                                                                                               label="{{$v3->title}}"
                                                                                                               link="{{$v3->url}}"><i class="fa fa-pencil"></i></a>
                                                                                                            <a title="Remove"
                                                                                                               data-id="{{$v3->id}}"
                                                                                                               class="removeCategory btn btn-danger btn-sm del-button text-white">
                                                                                                                <i class="fa fa-trash"></i></a>
                                                                                                        </span>
                                                                                                        </div>
                                                                                                        @foreach($v3->getChildCategory as $k4=>$v4)
                                                                                                            <ol class="child"
                                                                                                                id="category-id">
                                                                                                                <li class="dd-item dd3-item"
                                                                                                                    data-id="{{$v4->id}}">
                                                                                                                    <div class="dd-handle dd3-handle"></div>
                                                                                                                    <div class="dd3-content">
                                                                                                                    <span id="label_show{{$v4->id}}"><i
                                                                                                                                class="{{$v4->icon}}"></i> {{$v4->title}}</span>
                                                                                                                        <span class="span-right">
                                                                                                                            <label class="switch">
                                                                                                                                <input type="checkbox" id="togBtn" @if($v4->active==1) checked @endif onclick="categoryStatus('{{$v4->id}}','{{$v4->active}}')">
                                                                                                                                <span class="slider round">
                                                                                                                                    <!--ADDED HTML -->
                                                                                                                                    <span class="on">ON</span>
                                                                                                                                    <span class="off">OFF</span>
                                                                                                                                    <!--END-->
                                                                                                                                </span>
                                                                                                                            </label>
                                                                                                                            <a href="category/{{$v4->id}}/edit"
                                                                                                                               class="btn btn-primary btn-sm edit-button"
                                                                                                                               id="{{$v4->id}}"
                                                                                                                               label="{{$v4->title}}"
                                                                                                                               link="{{$v4->url}}"><i
                                                                                                                                        class="fa fa-pencil"></i></a>
                                                                                                                            <a title="Remove"
                                                                                                                               data-id="{{$v4->id}}"
                                                                                                                               class="removeCategory btn btn-danger btn-sm del-button text-white">
                                                                                                                                <i class="fa fa-trash"></i></a>
                                                                                                                    </span>
                                                                                                                    </div>
                                                                                                                    @foreach($v4->getChildCategory as $k5=>$v5)
                                                                                                                        <ol class="child"
                                                                                                                            id="category-id">
                                                                                                                            <li class="dd-item dd3-item"
                                                                                                                                data-id="{{$v5->id}}">
                                                                                                                                <div class="dd-handle dd3-handle"></div>
                                                                                                                                <div class="dd3-content">
                                                                                                                                <span id="label_show{{$v5->id}}"><i
                                                                                                                                            class="{{$v5->icon}}"></i> {{$v5->title}}</span>
                                                                                                                                    <span class="span-right">
                                                                                                                                        <label class="switch">
                                                                                                                                            <input type="checkbox" id="togBtn" @if($v5->active==1) checked @endif onclick="categoryStatus('{{$v5->id}}','{{$v5->active}}')">
                                                                                                                                            <span class="slider round">
                                                                                                                                                <!--ADDED HTML -->
                                                                                                                                                <span class="on">ON</span>
                                                                                                                                                <span class="off">OFF</span>
                                                                                                                                                <!--END-->
                                                                                                                                            </span>
                                                                                                                                        </label>
                                                                                                                                    <a href="category/{{$v5->id}}/edit"
                                                                                                                                       class="btn btn-primary btn-sm edit-button"
                                                                                                                                       id="{{$v5->id}}"
                                                                                                                                       label="{{$v5->title}}"
                                                                                                                                       link="{{$v5->url}}"><i
                                                                                                                                                class="fa fa-pencil"></i></a>
                                                                                                                                    <a title="Remove"
                                                                                                                                       data-id="{{$v5->id}}"
                                                                                                                                       class="removeCategory btn btn-danger btn-sm del-button text-white">
                                                                                                                                        <i class="fa fa-trash"></i></a>
                                                                                                                                </span>
                                                                                                                                </div>
                                                                                                                            </li>
                                                                                                                        </ol>
                                                                                                                    @endforeach
                                                                                                                </li>
                                                                                                            </ol>
                                                                                                        @endforeach
                                                                                                    </li>
                                                                                                </ol>
                                                                                            @endforeach
                                                                                        </li>
                                                                                    </ol>
                                                                                @endforeach
                                                                            </li>
                                                                        </ol>
                                                                    @endforeach
                                                                </li>
                                                            </ol>
                                                        @endforeach
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center">
                                        <img alt="No Data Found!" class="img-fluid"
                                             src="{{url("files/shares/icons/no_data_found.png")}}"
                                             alt="No Record Found">
                                    </div>
                                @endif
                                <input type="hidden" id="nestable-output">
                                {{--modal for remove category--}}
                                <div class="modal fade" id="removeCategoryItem">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title">Warning</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body bg-white">
                                                <p>Are you sure that you want to permanently delete the
                                                    selected item?</p>
                                                <p><strong>Notice!</strong> All of related Sub Categories will be deleted</p>
                                                <input type="hidden" name="categoryId" id="categoryId" value=""/>
                                            </div>
                                            <div class="modal-footer bg-white">
                                                <button onclick="deleteCategory()" data-id="" class="btn btn-danger">Delete
                                                </button>
                                                <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close
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
    <!-- modals for delete-->
    <!-- Large modal -->
@endsection
@section('scripts')
    <script src="{{url('js/jquery.nestable.js')}}"></script>
    <script>
        $(document).ready(function () {
            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target);
                var output = list.data('output');
                if (typeof (output) != 'undefined') {
                    if (window.JSON) {
                        output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                    } else {
                        output.val('JSON browser support required for this demo.');
                    }
                }

            };
            // activate Nestable for list 1
            $('#nestable').nestable({
                group: 1
            }).on('change', updateOutput);

            // output initial serialised data
            updateOutput($('#nestable').data('output', $('#nestable-output')));

            $('#nestable-category').on('click', function (e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });
        });

        $(document).ready(function () {
            $('.dd').on('change', function () {
                var dataString = {
                    data: $("#nestable-output").val(),
                };
                $.ajax({
                    type: "POST",
                    url: "category/sorting",
                    data: {data: dataString, _token: '{{csrf_token()}}'},
                    cache: false,
                    success: function (data) {

                    }, error: function (xhr, status, error) {
                        alert(error);
                    },
                });
            });
        });

        $(document).on("click", ".removeCategory", function () {
            var categoryId = $(this).data('id');
            $(".modal-body #categoryId").val(categoryId);
            $('#removeCategoryItem').modal('show');
        });

        function deleteCategory() {
            var id = $('input#categoryId').val();
            var deleteForm = '<form method="post" action="category/destroy">' +
                '<input name="id" value="' + id + '"/>' +
                '<input name="_method" value="delete"/>' +
                '<input name="_token" value="{{csrf_token()}}"/>' +
                '</form>';
            $(deleteForm).appendTo('body').submit();
        }

        function categoryStatus(id, status) {
            if (status === '1') {
                var newStatus = 0;
            } else {
                var newStatus = 1;
            }

            $.ajax({
                url: "category/refreshCategoryStatus",
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
    </script>
    <!-- END Java Script for this page -->

@endsection