<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['title','parent_id','url','image','icon','active','description'];

/*    public function allCategories(){
        $allCategories = self::with('getParentCategory')->orderby('id','desc')->paginate(10);
        return $allCategories;
    }*/
    public function allCategories(){
        $allCategories = self::where('parent_id',0)->with('getChildCategory')->orderby('order')->get();
        return $allCategories;
    }

    public function getCategoryList(){
        $categoryList=array();
        $allCategoryList = self::with('getChildCategory')->where('parent_id',0)->get();
        foreach ($allCategoryList as $index1 => $category1){
            $categoryList[$category1->id] = $category1->title;
            foreach ($category1->getChildCategory as $index2 => $category2){
                $categoryList[$category2->id] = '-- '.$category2->title;
            }
        }
        return $categoryList;
    }

    public function getChildCategory(){
        return $this->hasMany(Category::class,'parent_id','id')->with('getChildCategory');
    }

    public function getChildrenCategories($id){
        $childrenCategories = self::where('parent_id',$id)->orderby('order')->pluck('id')->toArray();
        return $childrenCategories;
    }

    public function getParentCategory(){
        return $this->hasOne(Category::class,'id','parent_id')->withDefault(['title' => '']);
    }
}
