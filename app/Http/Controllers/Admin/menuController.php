<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Gallery;
use App\Http\Requests\menuRequest;
use App\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = new Menu();
        $allMenus = $menu->allMenus();
        $menuList = $menu->getMenuList();
        $categoryList = Category::all();
        $galleryList = Gallery::all();
        $menuTypes = config('services.menuTypes');
        return view('admin/menu/index',compact('allMenus','menuList','categoryList','galleryList','menuTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = new Menu();
        $menuList = $menu->getMenuList();
        $categoryList = Category::all();
        $galleryList = Gallery::all();
        $menuTypes = config('services.menuTypes');
        return view('admin/menu/create',compact('menuList','categoryList','galleryList','menuTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(menuRequest $request)
    {
        $menu = new Menu($request->all());
        $menuType = $request->get('menuType');
        if($menuType === 'home'){
            $menu->type = 'home';
            $menu->link = '/';
        }elseif($menuType === 'contact'){
            $menu->type = 'contact';
            $menu->link = 'contact';
        }elseif ($menuType === 'category'){
            $menu->type = 'category';
            $catMenuUrl = $request->get('category');
            if($catMenuUrl==='all'){
                $menu->link = 'category/all';
            }else{
                $menu->link = 'category/'.$catMenuUrl;
            }
        }elseif ($menuType === 'gallery'){
            $menu->type = 'gallery';
            $galMenuUrl = str_replace('_',' ',$request->get('gallery'));
            $galMenuUrl = preg_replace('/\s+/','_',$galMenuUrl);
            if($galMenuUrl==='all'){
                $menu->link = 'gallery/all';
            }else{
                $menu->link = 'gallery/'.$galMenuUrl;
            }
        }else{
        //$menuType === 'content')
            $link = str_replace('_',' ',$request->get('title'));
            $link = preg_replace('/\s+/','_',$link);
            $menu->type = 'content';
            $menu->link = strtolower($link);
        }

        $menu->active = ($request->get('active') === 'on')? 1 : 0;
        $lastOrder = $menu->max('order');
        $menu->order =  is_null($lastOrder) ? 0 : $lastOrder+1;

        if($menu->save()){
            $result = array('status'=>'success','message'=>"Menu ".$request->get('title')." has been added!");
        }else{
            $result = array('status'=>'danger','message'=>'something went wrong! Please try again.');
        }
        return redirect('admin/menu');
    }

    public function sortMenu($jsonArray, $parentID = 0) {

        $return = array();
        foreach ($jsonArray as $subArray) {
            $returnSubSubArray = array();
            if (isset($subArray->children)) {
                $returnSubSubArray = $this->sortMenu($subArray->children, $subArray->id);
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
        $readbleArray = $this->sortMenu($string);
        $i=1;
        foreach ($readbleArray as $row){
            DB::table('menu')->where('id', $row['id'])->update(['parent' => $row['parentID'],'order'=>$i]);
            $i++;
        }
    }

    public function refreshStatus(Request $request){
        $id = $request->get('id');
        $status = $request->get('active');
        $result = array('status'=>'error');
        if(isset($id) && isset($status)){
            $menu = Menu::findOrFail($id);
            if($menu->update($request->all())){
                $result['status'] = 'success';
            }
        }
        return $result;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = new Menu();
        $editMenu = $menu->findOrFail($id);
        $menuList = $menu->getMenuList();
        $categoryList = Category::all();
        $galleryList = Gallery::all();
        $menuTypes = config('services.menuTypes');
        if (strpos($editMenu->type, 'category') === 0) {
            $categoryUrl = explode('/',$editMenu->link);
            $editMenu['category'] = $categoryUrl[1];
        }elseif (strpos($editMenu->type, 'gallery') === 0){
            $galleryUrl = explode('/',$editMenu->link);
            $editMenu['gallery'] = $galleryUrl[1];
        }
        return view('admin/menu/edit',compact('editMenu','menuList','categoryList','galleryList','menuTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update($id,menuRequest $request)
    {
        $updateMenu = Menu::findOrFail($id);
        $requestData = $request->all();
        $requestData['active'] = ($request->get('active') === 'on')? 1 : 0;
        $updateMenu->update($requestData);
        return redirect('admin/menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $deleteMenu = Menu::findOrFail($id);
        $deleteMenu->delete();
        DB::table('menu')->where(['parent'=>$id])->delete();
        return redirect('admin/menu');
    }
}
