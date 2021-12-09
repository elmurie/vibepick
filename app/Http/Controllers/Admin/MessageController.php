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
        $messages = Message::all()->where('user_id', $user->id);
        return view("admin.messages.index", compact("messages", "user"));
    }
}
