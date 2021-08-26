<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = ['title','link','parent','order','icon','active'];

    public function allMenus(){
        return self::with('getChildMenu')->where(['parent'=>0])->orderBy('order')->get();
    }

    public function getMenuList(){
        $menuList=array();
        $allMenuList = self::with('getChildMenu')->where('parent',0)->get();
        foreach ($allMenuList as $index1 => $menu1){
            $menuList[$menu1->id] = $menu1->title;
            foreach ($menu1->getChildMenu as $index2 => $menu2){
                $menuList[$menu2->id] = '-- '.$menu2->title;
            }
        }
        return $menuList;
    }

    public function getChildMenu(){
        return $this->hasMany(menu::class,'parent','id');
    }
}
