<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Storage;
use App\User;
use App\Message;

class MessageController extends Controller
{
    public function index(User $user)
    {   
        $user=Auth::user();
        $messages = Message::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        foreach($messages as $message){
            // dd(date_format($message['created_at'], "H:i:s d-m-Y"));
            $format_date = date_format($message['created_at'], "H:i:s d-m-Y");
            $message['format_date'] = $format_date;
        }
        return view("admin.messages.index", compact("messages", "user"));
    }
}
