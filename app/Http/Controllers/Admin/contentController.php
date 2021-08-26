<?php

namespace App\Http\Controllers\Admin;

use App\Content;
use App\Http\Requests\contentRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class contentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allContents = Content::allContents();
        $category = new Category();
        $categoryList = $category->getCategoryList();
        return view('admin/content/index',compact('allContents','categoryList'));
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
        return view('admin/content/create',compact('categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(contentRequest $request)
    {
        $content = new Content($request->all());
        $url = str_replace('_',' ',$request->get('title'));
        $url = preg_replace('/\s+/','-',$url);
        $content->url = strtolower($url);
        if($content->save()){
            return redirect('admin/content');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editContent = Content::findOrFail($id);
        $category = new Category();
        $categoryList = $category->getCategoryList();
        return view('admin/content/edit',compact('editContent','categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(contentRequest $request, $id)
    {
        $updateContent = Content::findOrFail($id);
        $url = str_replace('_',' ',$request->get('title'));
        $url = preg_replace('/\s+/','-',$url);
        $requestData = $request->all();
        $requestData['url'] = strtolower($url);
        $updateContent->update($requestData);
        return redirect('admin/content');
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
        $deleteContent = Content::findOrFail($id);
        $deleteContent->delete();
        return redirect('admin/content');
    }

    public function contentBulkRemove(Request $request){
        $result = array('status'=>'error');
        $selectedContentIds = $request->get('selected');
        $removeCategories = Content::whereIn('id',$selectedContentIds);
        if($removeCategories->delete()){
            $result['status'] = 'success';
        }
        return $result;
    }
}
