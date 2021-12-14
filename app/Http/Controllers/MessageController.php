<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {   

        $request->validate([
            'user_id'=> 'required | numeric',
            'firstname' => 'required | string | max:100',
            'lastname' => 'required | string | max:100',
            'email' => 'required | email',
            'content' => 'required | text | max:15000',
        ]);

        
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
