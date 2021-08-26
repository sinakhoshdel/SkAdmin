<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use App\Settings;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function index(){
        return view('admin/dashboard');
    }

    public function settings(){
        $selectedPermission = [];
        $generalSetting = DB::table('settings')->first();
        $adminUsers = User::where('role','!=', 1)->with('roles')->latest()->paginate(10);
        $adminRoles = Role::where('name','!=','user')->get();
        foreach ($adminRoles as $role){
            $selectedPermission[$role->id] = $role->permissions->pluck('id')->toArray();
        }
        $adminPermissions = Permission::latest()->get();
        return view('admin/settings/settings',compact('generalSetting','adminUsers', 'adminRoles','selectedPermission','adminPermissions'));
    }

    public function saveGeneralSettings(Request $request){
        $settings = Settings::first();
        if($settings->update($request->all())){
            return redirect('admin/settings');
        }
    }
}
