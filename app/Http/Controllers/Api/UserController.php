<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Instrument;
use App\User;

class UserController extends Controller
{
    public function index()
    {   //prendi gli user con le recensioni solo se hanno almeno uno strumento assegnato
        $users = User::with('reviews')->with('instruments')->whereHas('sponsorships', function(Builder $query){
            date_default_timezone_set('Europe/Rome');
            $nowDate = date("Y-m-d H:i:s");
            $query->where('end_time', '>', $nowDate)->where('start_time', '<', $nowDate);
        })
        ->with('instruments')
        ->with('reviews')
        ->withCount('reviews')
        ->get();

        $usersFiltered = [];
        foreach($users as $user){
            //ToDo rendere questo snippet di codice una funzione da richiamare qui e nello show in modo da non ripetere
            $vote=0;
            $average=0;
            if($user['reviews_count'] > 0) {
                foreach ($user['reviews'] as $review) {
                    $vote+= $review['vote'];
                }
        
                $avg = $vote/$user['reviews_count'];
                $average=round($avg, 1);
            }
    
            $user['avgVote'] = $average;
            $usersFiltered[] = $user;
        }
        
        
        

        return response()->json([
            'success' => true,
            'data' => $usersFiltered,
        ]);
    }

    public function show($id) {
        $user=User::find($id)
        ->whereHas('instruments', function (Builder $query) use($id){
            $query->where('user_id', $id);
        })
        ->with('instruments')
        ->with('reviews')
        ->withCount('reviews')
        ->get();
        
        $vote=0;
        $average=0;

        $user=$user[0];
        if($user['reviews_count'] > 0) {
            foreach ($user['reviews'] as $review) {
                $vote+= $review['vote'];
            }
            $avg = $vote/$user['reviews_count'];
            $average=round($avg, 1);
        }

        $user['avgVote'] = $average;

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

}
