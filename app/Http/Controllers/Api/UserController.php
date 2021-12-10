<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
            // $users = User::join('reviews', 'reviews.user_id', '=', 'users.id')
        //             // ->join('reviews', 'reviews.user_id', '=', 'users.id')
        //             ->get(['users.firstname', 'reviews.vote'])->first();
        $users = User::with('reviews')->with('instruments')->get();

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }
}
