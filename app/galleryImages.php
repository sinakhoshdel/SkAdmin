<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class galleryImages extends Model
{
    protected $table = 'gallery_image';
    protected $fillable = ['gallery_id','name','size','mimeType','path'];

    public function gallery(){
        return $this->belongsTo('App\Gallery');
    }
}
