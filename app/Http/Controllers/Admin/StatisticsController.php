<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;
use App\Review;
use App\Chart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index(User $user)
    {   
        $user = Auth::user();
        $messages = Message::where('user_id', $user->id)->get();
        $reviews = Review::where('user_id', $user->id)->orderBy('created_at', 'asc')
        ->get();

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

        //count review diviso per mese 
        $reviewsMonth = new Chart;
        $monthsArray = [
            0 => 'Gennaio', 
            1 => 'Febbraio', 
            2 => 'Marzo', 
            3 => 'Aprile', 
            4 => 'Maggio', 
            5 => 'Giugno', 
            6 => 'Luglio', 
            7 => 'Agosto', 
            8 => 'Settembre', 
            9 => 'Ottobre', 
            10 => 'Novembre', 
            11 => 'Dicembre'
       ];

        $monthly_uploaded_product = DB::table('reviews')
        ->where('user_id', $user->id)
        ->select(DB::raw('count(id) as total'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get();

        $year = [
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
        
        ];//initialize all months to 0

        foreach($monthly_uploaded_product as $key => $value) {
        $year[$value->month-1] = $value->total;//update each month with the total value
        };

        $reviewsMonth['mesi'] = $monthsArray;
        $reviewsMonth['tot'] = $year;


        // count messaggi diviso per mese 
        $messagesMonth = new Chart;
        $monthly_messages = DB::table('messages')
        ->where('user_id', $user->id)
        ->select(DB::raw('count(id) as total'), DB::raw('MONTH(created_at) as month'))
        ->groupBy('month')
        ->get();

        $year_messages = [
            0 => 0,
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
        
        ];//initialize all months to 0

        foreach($monthly_messages as $key => $value) {
        $year_messages[$value->month-1] = $value->total;//update each month with the total value
        };

        $messagesMonth['mesi'] = $monthsArray;
        $messagesMonth['tot'] = $year_messages;


        return view('admin.statistics.index', compact('user', 'messages', 'reviews', 'chart', 'reviewsMonth', 'messagesMonth'));
    }
}
