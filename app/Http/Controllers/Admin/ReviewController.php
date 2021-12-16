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
        $reviews = Review::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        foreach($reviews as $review){
            // dd(date_format($review['created_at'], "H:i:s d-m-Y"));
            $format_date = date_format($review['created_at'], "H:i:s d-m-Y");
            $review['format_date'] = $format_date;
        }
        return view("admin.reviews.index", compact("reviews", "user"));
    }

    /* public function store(Request $request)
    {   
        $newReview = new Review();
        $newReview->user_id=$request->user_id;
        $newReview->title=$request->title;
        $newReview->author=$request->author;
        $newReview->content=$request->content;
        $newReview->vote=$request->vote;
        $newReview->save();

        return redirect('/showartist'.'/'.$newReview->user_id);
    } */

    public function show()
    {   
        return redirect('/404');
    }

}
