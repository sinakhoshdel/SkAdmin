<?php

namespace App\Http\Controllers;

use App\Content;
use App\Mail\contactMessages;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\contact;
use Illuminate\Support\Facades\View;
use App\Menu;
class siteController extends Controller
{
    public function renderPage($url=null){
        $menus = Menu::whereActive(1)->get();
        if(is_null($url)){
            return view("site.home",compact('menus'));
        }elseif (View::exists("site.$url")) {
            return view("site.$url",compact('menus'));
        }else{
            $content = Content::whereUrl($url)->get();
            if(count($content)>0){
                return view("site.page",compact('content','menus'));
            }
            abort(404);

        }
    }

    public function postContact(Request $request){
        $message = new Message($request->all());
        if($message->save()){
            $data = $request->all();
            Mail::to('s.khoshdel66@gmail.com')->send(new contactMessages($data));
            return redirect()->back()->with('success', 'Your message has been sent successfully!');
        }else{
            return redirect()->back()->with('error', 'Something went wrong! Please try again');
        }
    }
}
