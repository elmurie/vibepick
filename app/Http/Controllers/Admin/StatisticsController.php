<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;
use App\Review;
use App\Chart;

class StatisticsController extends Controller
{
    public function index(User $user)
    {   
        $user = Auth::user();
        $messages = Message::where('user_id', $user->id)->get();
        $reviews = Review::where('user_id', $user->id)->get();

        $chart = new Chart;
        $voti = [];
        foreach ($reviews as $value){
            $voti[] = $value->vote;
        };
        $chart['voti'] = $voti;
        $date = [];
        foreach ($reviews as $value){
            $date[] = date_format($value->created_at, "d-m-Y H:i:s");
        };
        $chart['date'] = $date;

        return view('admin.statistics.index', compact('user', 'messages', 'reviews', 'chart'));
    }
}
