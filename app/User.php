<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role','name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        $adminRoles = ['admin','support'];
        $role = Role::find($this->role);
        if(!is_null($role) && in_array($role->name,$adminRoles)){
            return true;
        }
        return false;
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function hasRole($role){
        if(is_string($role)){
            return $this->roles->contains('name',$role);
        }
        foreach ($role as $obj){
            if($this->hasRole($obj->name)){
                return true;
            }
        }
        return false;
    }

    public function getRoleName(){
        return $this->hasOne(Role::class,'id','role')->withDefault(['title' => 0]);
    }
}
