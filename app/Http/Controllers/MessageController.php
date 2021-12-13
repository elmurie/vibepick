<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {   
        $newMessage = new Message();
        $newMessage->user_id=$request->user_id;
        $newMessage->firstname=$request->firstname;
        $newMessage->lastname=$request->lastname;
        $newMessage->email=$request->email;
        $newMessage->text=$request->text;
        $newMessage->save();

        return redirect('/showartist'.'/'.$newMessage->user_id);
    }
}
