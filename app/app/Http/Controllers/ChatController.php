<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $id = $request->id;
        if($id){
            $validate = User::where('id', $id)->first();
            if($validate){
                $user = User::where('id', Auth::id())->first();
                $receiver = User::whereId($request->id)->first();
                return view('chat', ['user' => $user, 'receiver' => $receiver]);
            }else return redirect(route('messages'));
        
        }else{
            return redirect(route('messages'));
        }
    }

    public function list(){

          $user = Auth::user();
    

         $messages = DB::table('messages')->where('sender_id', $user->id)->orWhere('receiver_id', $user->id)->get();
         

          foreach ($messages as $msg) {
                  if($msg->sender_id == $user->id){
                  echo "<div id='chat-right' align = 'right'><label class='msg'>".$msg->text."</label></div>";
                  }else{
        
                  echo "<div id='chat-left' align = 'left'><label class='msg'>".$msg->text."</label></div>";
                  }
        
             }

        
        
        
        }
    
}