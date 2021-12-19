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
        ->get();
        

        //Recupero della data odierna
        date_default_timezone_set('Europe/Rome');
        $nowD = date("Y-m-d H:i:s");

        $nowDate = new DateTime($nowD);
        
        foreach($userSponsor[0]['sponsorships'] as $spons){

            //Rendere le date oggetti DateTime
            $start_time = new DateTime($spons['pivot']['start_time']);
            $end_time = new DateTime($spons['pivot']['end_time']);
            $created_at = $spons['pivot']['created_at'];
            $created_at = $created_at->format("d-m-Y H:i");
            
            //Assegnazione di una classe per l'eventuale sponsorizzazione attiva
            if($start_time < $nowDate && $end_time > $nowDate){
                $spons['now_active'] = 'active';
            }else{
                $spons['now_active'] = 'not-active';
            }
            
            //Formattazione delle date per la visione a video
            $spons['pivot']['start_time'] = date_format($start_time, "d-m-Y H:i");
            $spons['pivot']['end_time'] = date_format($end_time, "d-m-Y H:i");
            $spons['pivot']['sale_time'] = $created_at;
        };

        $prova = $userSponsor[0]['sponsorships']; 

        // return response()->json(['data' => $prova]);

        $sponsorships = Sponsorship::all();
        
        
        return view('admin.sponsor.index', compact('sponsorships', 'prova'));
    }
}
