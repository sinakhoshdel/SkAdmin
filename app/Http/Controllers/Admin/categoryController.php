<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\categoryRequest;
use DemeterChain\C;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = new Category();
        $allCategories = $category->allCategories();
        $categoryList = $category->getCategoryList();
        return view('admin/category/index',compact('allCategories','categoryList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        $categoryList = $category->getCategoryList();
        return view('admin/category/create',compact('categoryList'));
    }

    /**
     * Search category
     * @param string searchCategory
     * @return category list
     */
    public function search(Request $request){
        $category = new Category();
        $allCategories = $category->searchCategory($request->all());
        $categoryList = $category->getCategoryList();
        return view('admin/category/index',compact('allCategories','categoryList'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(categoryRequest $request)
    {
        $category = new Category($request->all());
        $url = str_replace('_',' ',$request->get('title'));
        $url = preg_replace('/\s+/','_',$url);
        $category->url = $url;
        $category->active = ($request->get('active') === 'on')? 1 : 0;
        $lastOrder = $category->max('order');
        $category->order =  is_null($lastOrder) ? 0 : $lastOrder+1;
        if(is_null($request->get('image')) || empty($request->get('image'))){
            $category->image = 'images/default-category.png';
        }
       $category->save();
        return redirect('admin/category');
    }

    public function sortCategory($jsonArray, $parentID = 0) {

        $return = array();
        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray->children)) {
                $returnSubSubArray = $this->sortCategory($subArray->children, $subArray->id);
            }

            $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
            $return = array_merge($return, $returnSubSubArray);
        }
        return $return;
    }

    public function sort(Request $request)
    {
        $data = $request->get('data');

        $string = json_decode($data['data']);
        $readbleArray = $this->sortCategory($string);
        $i=1;
        foreach ($readbleArray as $row){
            DB::table('category')->where('id', $row['id'])->update(['parent_id' => $row['parentID'],'order'=>$i]);
            $i++;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = new Category();
        $editCategory = $category->findOrFail($id);
        $categoryList = $category->getCategoryList();
        $getChildrenCategories = $category->getChildrenCategories($editCategory->id);
        return view('admin/category/edit',compact('editCategory','categoryList','getChildrenCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id , categoryRequest $request)
    {
        $updateCategory = Category::findOrFail($id);
        $requestData = $request->all();
        $url = str_replace('_',' ',$request->get('title'));
        $url = preg_replace('/\s+/','_',$url);
        $requestData['url'] = $url;
        /*if($request->hasFile('icon')){
            $fileName = 'icon'.time().'.'.$request->file('icon')->getClientOriginalExtension();
            if($request->file('icon')->move('upload/icons',$fileName)){
                $requestData['icon'] = $fileName;
            }
        }*/
        if(is_null($request->get('image')) || empty($request->get('image'))){
            $requestData['image'] = 'images/default-category.png';
        }
        $requestData['active'] = ($request->get('active') === 'on')? 1 : 0;
        $updateCategory->update($requestData);
        return redirect('admin/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $deleteCategory = Category::findOrFail($id);
        $deleteCategory->delete();
        DB::table('category')->where(['parent_id'=>$id])->delete();
        return redirect('admin/category');
    }

    /**
     * refresh category status
     * @param integer id
     * @param integer status
     * @return Response
     */

    public function refreshStatus(Request $request){
       $id = $request->get('id');
       $status = $request->get('active');
       $result = array('status'=>'error');
       if(isset($id) && isset($status)){
           $category = Category::findOrFail($id);
           if($category->update($request->all())){
               $result['status'] = 'success';
           }
       }
       return $result;
    }

    public function categoryBulkRemove(Request $request){
        $result = array('status'=>'error');
        $selectedCategoryIds = $request->get('selected');
        $removeCategories = Category::whereIn('id',$selectedCategoryIds);
        if($removeCategories->delete()){
            $result['status'] = 'success';
        }
        return $result;
    }
}
