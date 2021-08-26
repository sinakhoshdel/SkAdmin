<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';
    protected $fillable = ['title','url','category','metaTags','metaDescription','content'];

    public static function allContents(){
        $allContents = self::with('getCategoryName')->orderBy('id', 'desc')->paginate(10);
        return $allContents;
    }

    public function getCategoryName(){
        return $this->hasOne(Category::class,'id','category')->withDefault(['title' => 0]);
    }
}
