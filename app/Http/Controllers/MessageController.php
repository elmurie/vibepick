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
            'firstname' => 'required | string | max:50',
            'lastname' => 'required | string | max:50',
            'email' => 'required | email',
            'text' => 'required | string | max:1500',
        ]);

        
        $newMessage = new Message();
        $newMessage->user_id=$request->user_id;
        $newMessage->firstname=ucfirst(strtolower($request->firstname));
        $newMessage->lastname=ucfirst(strtolower($request->lastname));
        $newMessage->email=$request->email;
        $newMessage->text=ucfirst($request->text);
        $newMessage->save();

        return redirect('/showartist'.'/'.$newMessage->user_id)->with('message_sent','Il messaggio è stato inviato');
    }
}
