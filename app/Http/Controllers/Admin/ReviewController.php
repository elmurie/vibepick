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

    public function store(Request $request)
    {   
        $newReview = new Review();
        $newReview->user_id=$request->user_id;
        $newReview->title=$request->title;
        $newReview->author=$request->author;
        $newReview->content=$request->content;
        $newReview->vote=$request->vote;
        $newReview->save();

        return redirect('/showartist'.'/'.$newReview->user_id);
    }

}
