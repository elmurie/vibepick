<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class ReviewController extends Controller
{
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
