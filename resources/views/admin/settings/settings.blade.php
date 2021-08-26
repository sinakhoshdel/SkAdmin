@extends('admin.sections.master')
@section('title','Settings')
@section('styles')
    <link rel="stylesheet" href="{{url('css/tabs.css')}}">
    <link rel="stylesheet" href="{{url('css/tagsinput.css')}}">
@endsection
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-holder">
                            <h1 class="main-title float-left">Settings</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">Settings</li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="displayErrors">
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
                </div>
            </div>
            <!-- END container-fluid -->

            <!-- Classic tabs -->
            <div class="classic-tabs mx-2">
                <ul class="nav tabs-orange" id="settingsTab" role="tablist">
                    <li class="nav-item">
                        <a class="text-center nav-link waves-light active show" id="general-settings-tab" data-toggle="tab" href="#general-settings"
                           role="tab" aria-controls="general-settings" aria-selected="false">
                            <i class="fa fa-cog fa-2x pb-2" aria-hidden="true"></i><br>General Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-center nav-link waves-light" id="admin-users-tab" data-toggle="tab" href="#admin-users"
                           role="tab" aria-controls="admin-users" aria-selected="true">
                            <i class="fa fa-users fa-2x pb-2" aria-hidden="true"></i><br>Admin Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-center nav-link waves-light" id="admin-roles-tab" data-toggle="tab" href="#admin-roles"
                           role="tab" aria-controls="admin-roles" aria-selected="false">
                            <i class="fa fa-user-secret fa-2x pb-2" aria-hidden="true"></i><br>Admin Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="text-center nav-link waves-light" id="permissions-tab" data-toggle="tab" href="#permissions"
                           role="tab" aria-controls="permissions" aria-selected="false">
                            <i class="fa fa-key fa-2x pb-2" aria-hidden="true"></i><br>Permissions</a>
                    </li>
                </ul>
                <div class="tab-content" id="myClassicTabContent" style="min-height: 350px">
                    {{-- general settings tab--}}
                        @include('admin.settings.generalSettings')
                    {{-- end of general settings tab--}}
                    
                    {{--admin users tab--}}
                        @include('admin.settings.adminUsers')
                    {{-- end of admin users tab --}}
                    
                    {{--admin roles tab--}}
                        @include('admin.settings.adminRoles')
                    {{-- end of admin roles tab--}}
                    
                    {{--admin permissions tab--}}
                        @include('admin.settings.permissions')
                    {{--end of admin permissions tab--}}
                </div>
            </div>
            <!-- Classic tabs -->
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#lfm').filemanager('file', {prefix: route_prefix});
        $('#lfm1').filemanager('file', {prefix: route_prefix});
        $('#lfm2').filemanager('file', {prefix: route_prefix});

        $(document).on("click", ".removeRow", function () {
            var rowId = $(this).data('id');
            var form = $(this).data('form');
            $("#"+form+" #rowId").val(rowId);
            $("#"+form+" #whichForm").val(form);
            $("#"+form).modal('show');
        });

        function deleteRow(id,form) {
            var action;
            switch (form) {
                case 'removePermission':
                    action = 'permissions';
                    break;
                case 'removeRole':
                    action = 'roles';
                    break;
                    case 'removeUser':
                    action = 'users';
                    break;
                default:
                    action = '';
            }
            var deleteForm = '<form method="post" action="'+action+'/destroy">' +
                '<input name="id" value="' + id + '"/>' +
                '<input name="_method" value="delete"/>' +
                '<input name="_token" value="{{csrf_token()}}"/>' +
                '</form>';
            $(deleteForm).appendTo('body').submit();
        }
    </script>
    <script src="{{url('js/tagsinput.js')}}"></script>
@endsection