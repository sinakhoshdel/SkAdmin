<?php

namespace App\Http\Controllers\Admin;

use App\Gallery;
use App\galleryImages;
use App\Http\Requests\galleryRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class galleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = new Gallery();
        $allGalleries = $gallery->allGalleries();
        return view('admin/gallery/index',compact('allGalleries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/gallery/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(galleryRequest $request)
    {
        $gallery = new Gallery($request->all());
        $gallery['active'] = ($request->get('active') === 'on')? 1 : 0;
        if($gallery->save()){
            $result = array('status'=>'success','message'=>"Gallery ".$request->get('title')." has been added!");
        }else{
            $result = array('status'=>'danger','message'=>'something went wrong! Please try again.');
        }
        return redirect('admin/gallery');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editGallery = Gallery::with('getImages')->findOrFail($id);
        return view('admin/gallery/edit',compact('editGallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update($id, galleryRequest $request)
    {
        $updateGallery = Gallery::findOrFail($id);
        $requestData = $request->all();
        $requestData['active'] = ($request->get('active') === 'on')? 1 : 0;
        $updateGallery->update($requestData);
        return redirect('admin/gallery');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteImage = Gallery::findOrFail($id);
        $gallery_name = $deleteImage->title;
        $path = storage_path().'/files/shares/galleries/'.$gallery_name;
        File::deleteDirectory($path);
        DB::table('gallery_image')->where(['gallery_id'=>$id])->delete();
        $deleteImage->delete();
        return redirect('admin/gallery');
    }

    public function galleryBulkRemove(Request $request){
        $result = array('status'=>'error');
        $selectedGalleries = $request->get('selected');
        $removeGalleries = Gallery::whereIn('id',$selectedGalleries);
        if($removeGalleries->delete()){
            galleryImages::whereIn('gallery_id',$selectedGalleries)->delete();
            $result['status'] = 'success';
        }
        return $result;
    }

    public function removeImage(Request $request)
    {
        $result = array('status'=>'error');
        $deleteImage = galleryImages::findOrFail($request->get('id'));
        if($deleteImage->delete()){
            $result['status'] = 'success';
        }
        return $result;
    }

    public function refreshStatus(Request $request){
        $id = $request->get('id');
        $status = $request->get('active');
        $result = array('status'=>'error');
        if(isset($id) && isset($status)){
            $gallery = Gallery::findOrFail($id);
            if($gallery->update($request->all())){
                $result['status'] = 'success';
            }
        }
        return $result;
    }

    public function addGalleryImages($id){
        $editGallery = Gallery::with('getImages')->findOrFail($id);
        return view('admin/gallery/updateImages',compact('editGallery'));
    }

    public function uploadImage($id,Request $request){
        $validation = $request->validate([
            'file' => 'required|image|max:2048',
            'gallery_name' => 'required'
        ]);
        $file = $validation['file'];
        $gallery_name = $validation['gallery_name'];
        $file_name =  $gallery_name.'_'.time().'_'.$file->getClientOriginalName();
        $path = '/files/shares/galleries/'.$gallery_name;
        $fileSize = $file->getSize();
        $fileType = $file->getClientMimeType();
        $imageUrl = $file->storeAs($path,$file_name);
        if(isset($imageUrl)){
            galleryImages::create([
                'gallery_id'=>$id,
                'name' => $file_name,
                'size' => $fileSize,
                'mimeType' => $fileType,
                'path' => $imageUrl,
            ]);
        }
    }
}
