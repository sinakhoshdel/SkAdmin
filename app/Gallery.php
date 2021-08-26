<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $fillable =  ['title','active','description'];

    public function allGalleries(){
        $allGalleries = self::orderBy('id', 'desc')->paginate(10);
        return $allGalleries;
    }
    public function getImages(){
        return $this->hasMany(galleryImages::class,'gallery_id','id');
    }
}
