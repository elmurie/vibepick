<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Sponsorship;
use App\User;
use DateTime;

class SponsorshipController extends Controller
{
    public function index(User $user)
    {

        $user = Auth::user();

        $userSponsor = User::where('id', $user->id)
        ->with(['sponsorships' => function($query){
            $query->orderBy('start_time', 'desc');
        }])
        // ->orderBy('start_time', 'asc')
        ->get();
        
        foreach($userSponsor[0]['sponsorships'] as $spons){
            $start_time = new DateTime($spons['pivot']['start_time']);
            $spons['pivot']['start_time'] = date_format($start_time, "d-m-Y H:i");

            $end_time = new DateTime($spons['pivot']['end_time']);
            $spons['pivot']['end_time'] = date_format($end_time, "d-m-Y H:i");

            $created_at = new DateTime($spons['pivot']['created_at']);
            $spons['pivot']['created_at'] = date_format($created_at, "d-m-Y H:i");
        };

        $prova = $userSponsor[0]['sponsorships']; 

        // return response()->json(['data' => $prova]);

        $sponsorships = Sponsorship::all();
        
        
        return view('admin.sponsor.index', compact('sponsorships', 'prova'));
    }
}
