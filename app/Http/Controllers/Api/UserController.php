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
        $users = User::with('reviews')->has('instruments')->with('sponsorships')->get();
        
        

        return response()->json([
            'success' => true,
            'data' => $users
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
    
            $average=$vote/$user['reviews_count'];
        }

        $user['avgVote'] = $average;

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

}
