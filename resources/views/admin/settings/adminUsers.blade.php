<div class="tab-pane fade" id="admin-users" role="tabpanel" aria-labelledby="admin-users-tab">
    <div class="form-row">
        <div class="card-body table-responsive">
            <div class="mb-1 pull-right topButton">
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_add_user">
                    <i class="fa fa-plus" aria-hidden="true"></i> Add admin users
                </button>
                {{--add new user modal box--}}
                <div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true" id="modal_add_user">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{Route('users.store')}}" method="post">
                                {{csrf_field()}}
                                <div class="modal-header">
                                    <h5 class="modal-title">Add new user</h5>
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
                                                <input class="form-control" name="name" type="text" value="{{old('name')}}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Email(required)</label>
                                                <input class="form-control" name="email" type="text" value="{{old('email')}}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Password(required)</label>
                                                <input class="form-control" name="password" type="password" value="{{old('password')}}"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 form-group">
                                            <label>User Role</label>
                                            <select name="role" class="form-control">
                                                <option value="0">Select role</option>
                                                @foreach($adminRoles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Add user</button>
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
                            <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" class="" id="defaultChecked"  >
                            <label class="" for="defaultChecked"></label>
                        </div>
                    </th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th class="text-center" style="width:120px">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(count($adminUsers)>0)
                    @foreach($adminUsers as $index=>$user)
                        <tr>
                            <td>
                                <div class="">
                                    <input type="checkbox" name="selected[]" value="{{$user->id}}" class=" id="defaultChecked{{$user->id}}"  >
                                    <label class="" for="defaultChecked{{$user->id}}"></label>
                                </div>
                            </td>
                            <td><strong>{{$user->name}}</strong></td>
                            <td>{{$user->email}}</td>
                            <td>{{strtoupper($user->getRoleName->name)}}</td>
                            <td>0</td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_update_user{{$user->id}}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </button>
                                <a title="Remove" data-form="removeUser" data-id="{{$user->id}}" class="removeRow btn btn-danger btn-sm del-button text-white">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        {{--modal window for admin user update--}}
                        <div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true" id="modal_update_user{{$user->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{Route('users.update',$user->id)}}" method="post">
                                        {{csrf_field()}}
                                        @method('patch')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Update Admin User  <span class="text-success font-weight-bold">{{$user->name}}</span></h5>
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
                                                        <input class="form-control" name="name" type="text" value="{{$user->name}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Email(required)</label>
                                                        <input class="form-control" name="email" type="text" value="{{$user->email}}"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Password(required)</label>
                                                        <input class="form-control" name="password" type="password" value="" autocomplete="off"/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 form-group">
                                                    <label>User Role</label>
                                                    <select name="role" class="form-control">
                                                        <option value="0">Select role</option>
                                                        @foreach($adminRoles as $role)
                                                            <option {{$user->getRoleName->name===$role->name ?'selected':''}} value="{{$role->id}}">{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
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
                        <!--Modal window for delete -->
                        <div class="modal fade" id="removeUser">
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
                                        <button onclick="deleteRow($('#removeUser input#rowId').val(),$('#removeUser input#whichForm').val())" class="btn btn-danger">Delete</button>
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
            {{$adminUsers->appends(request()->input())->links()}}
        </div>
    </div>
</div>