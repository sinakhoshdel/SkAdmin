<div class="tab-pane fade" id="admin-roles" role="tabpanel" aria-labelledby="admin-roles-tab">
    <div class="form-row">
        <div class="card-body table-responsive">
            <div class="mb-1 pull-right">
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_add_role">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add New Role
                </button>
                {{--add new admin role modal box--}}
                <div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true" id="modal_add_role">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{Route('roles.store')}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-header">
                                    <h5 class="modal-title">Add new role</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span aria-hidden="true">&times;</span>
                                        <span class="sr-only">Close</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Name(required)</label>
                                                <input class="form-control" name="name" type="text" placeholder="enter role name"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Label</label>
                                                <input class="form-control" name="label" type="text" placeholder="enter some details"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label>Permissions</label>
                                                <div class="">
                                                    <input type="checkbox" onclick="$('input[name*=\'permission_id\']').prop('checked', this.checked);" class="" id="defaultCheckedAll">
                                                    <label class="ml-3 " for="defaultCheckedAll">Select All</label>
                                                </div>
                                            @foreach($adminPermissions as $index=>$permission)
                                                <div class="">
                                                    <input type="checkbox" name="permission_id[]" value="{{$permission->id}}" class="" id="defaultChecked{{$permission->id}}">
                                                    <label class="ml-3 " for="defaultChecked{{$permission->id}}">{{str_replace('_',' ',$permission->name)}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Add Role</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-hover table-striped" id="admin-content-table">
                <thead class="thead-dark">
                <tr>
                    <th>
                        <div class="">
                            <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" class="" id="defaultChecked">
                            <label class="" for="defaultChecked"></label>
                        </div>
                    </th>
                    <th>Name</th>
                    <th>Label</th>
                    <th class="text-center" style="width:120px">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @if(count($adminRoles)>0)
                        @foreach($adminRoles as $index=>$role)
                            <tr>
                                <td>
                                    <div class="">
                                        <input type="checkbox" name="selected[]" value="{{$role->id}}" class="" id="defaultChecked{{$role->id}}"  >
                                        <label class="" for="defaultChecked{{$role->id}}"></label>
                                    </div>
                                </td>
                                <td><strong>{{$role->name}}</strong></td>
                                <td>{{$role->label}}</td>
                                <td class="text-center">
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_update_role{{$role->id}}">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                    <a title="Remove" data-form="removeRole" data-id="{{$role->id}}" class="removeRow btn btn-danger btn-sm del-button text-white">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            {{--update role modal box--}}
                            <div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true" id="modal_update_role{{$role->id}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{Route('roles.update',$role->id)}}" method="post">
                                            @csrf
                                            @method('patch')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update role <span class="text-success font-weight-bold">{{$role->name}}</span></h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span aria-hidden="true">&times;</span>
                                                    <span class="sr-only">Close</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Name(required)</label>
                                                            <input class="form-control" name="name" type="text" value="{{$role->name}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label>Label</label>
                                                            <input class="form-control" name="label" type="text" value="{{$role->label}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 form-group">
                                                        <label>Permissions</label>
                                                        <div class="">
                                                            <input type="checkbox" onclick="$('input[class*=\'permission_id_{{$role->id}}\']').prop('checked', this.checked);"  id="defaultCheckedAll">
                                                            <label class="ml-3" for="defaultCheckedAll">Select All</label>
                                                        </div>
                                                        @foreach($adminPermissions as $permission)
                                                            <div>
                                                                <input type="checkbox" name="permission_id[]" class="permission_id_{{$role->id}}" id="defaultChecked{{$permission->id}}" value="{{$permission->id}}"
                                                                {{in_array($permission->id,$selectedPermission[$role->id]) ? 'checked' : ''}}>
                                                                <label class="ml-3" for="defaultChecked{{$permission->id}}">{{str_replace('_',' ',$permission->name)}}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update Role</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--Modal window for delete role-->
                            <div class="modal fade" id="removeRole">
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
                                            <input type="hidden" name="rowId" id="rowId" value=""/>
                                            <input type="hidden" name="whichForm" id="whichForm" value=""/>
                                        </div>
                                        <div class="modal-footer bg-white">
                                            <button onclick="deleteRow($('#removeRole input#rowId').val(),$('#removeRole input#whichForm').val())" class="btn btn-danger">Delete</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
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
        </div>
    </div>
</div>