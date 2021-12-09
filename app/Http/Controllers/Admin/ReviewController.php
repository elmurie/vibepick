<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Review;

class ReviewController extends Controller
{
    public function index(User $user)
    {   
        $user=Auth::user();
        $reviews = Review::all()->where('user_id', $user->id);
        return view("admin.reviews.index", compact("reviews", "user"));
    }
}
