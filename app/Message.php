<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table='message';
    protected $fillable=['first_name','last_name','phone','email','subject','message','unread'];

    public function allMessages(){
        $allMessages = self::orderBy('id', 'desc')->paginate(10);
        return $allMessages;
    }

    public function searchMessages($string){
        $messages=array();
        if(array_key_exists('search_message',$string)){
            $messages = self::orderby('id','desc')
                ->where('subject','like','%'.$string['search_message'].'%')
                ->orWhere('first_name','like','%'.$string['search_message'].'%')
                ->orWhere('last_name','like','%'.$string['search_message'].'%')
                ->orWhere('email','like','%'.$string['search_message'].'%')
                ->orWhere('message','like','%'.$string['search_message'].'%')
                ->paginate(10);
        }
        return $messages;
    }
}
