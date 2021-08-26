<?php

namespace App\Http\Controllers\Admin;

use App\Mail\contactMessages;
use App\Mail\replyContactMessage;
use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class messageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $message = new Message();
        $allMessages = $message->allMessages();
        return view('admin/message/index',compact('allMessages'));
    }

    public function show($id)
    {
        $message = Message::findOrFail($id);
        $message->update(array('unread'=>0));
        return view('admin/message/show',compact('message'));
    }

    /**
     * Search Message
     * @param string searchMessage
     * @return Messages list
     */
    public function search(Request $request){
        $message = new Message();
        $search_string = $request->search_message;
        if(is_null($search_string)){
            return redirect()->route('message.index');
        }else{
            $allMessages = $message->searchMessages($request->all());
            return view('admin/message/index',compact('allMessages','search_string'));
        }
    }

    public function messageBulkRemove(Request $request){
        $result = array('status'=>'error');
        $selectedMessages = $request->get('selected');
        $removeMessages = Message::whereIn('id',$selectedMessages);
        if($removeMessages->delete()){
            $result['status'] = 'success';
        }
        return $result;
    }

    public function replyMessage(Request $request){
        $data = $request->all();
        if(!empty($data['message'])){
            Mail::to($data['To'])->send(new replyContactMessage($data));
            if(count(Mail::failures()) > 0){
                return redirect()->back()->with('error', 'Something went wrong! Please try again');
            }else {
                return redirect()->back()->with('success', 'Your message has been sent successfully!');
            }
        }else{
            return redirect()->back()->with('error', 'Message field is required!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request){
        $id = $request->get('id');
        $deleteMessage = Message::findOrFail($id);
        $deleteMessage->delete();
        return redirect('admin/message');
    }
}
