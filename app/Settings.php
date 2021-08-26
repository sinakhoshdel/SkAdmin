<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
    protected $fillable = ['site_name','site_email','site_logo','admin_logo','fav_icon','site_tags','site_description'];
}
