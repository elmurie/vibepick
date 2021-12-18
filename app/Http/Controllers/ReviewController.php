<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {   

        $request->validate([
            'user_id'=> 'required | numeric',
            'title' => 'required | string | max:150',
            'author' => 'required | string | max:150',
            'content' => 'required | string | max:15000',
            'vote' => 'required | numeric | between:0,5',
        ]);

        $newReview = new Review();
        $newReview->user_id=$request->user_id;
        $newReview->title=ucfirst(strtolower(($request->title)));
        $newReview->author=ucwords(strtolower($request->author));
        $newReview->content=ucfirst($request->content);
        $newReview->vote=$request->vote;
        $newReview->save();

        return redirect('/showartist'.'/'.$newReview->user_id)->with('review_added','La recensione è stata salvata correttamente');
    }
}
