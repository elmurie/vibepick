<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Instrument;
use App\Review;
use App\User;


class InstrumentController extends Controller
{
    public function index()
    {
        $instruments = Instrument::all();

        return response()->json([
            'success' => true,
            'data' => $instruments
        ]);
    }

    public function show($slug, $rewMin)
    {

        //Chiamata sugli utenti 
        
        $users = User::with('instruments')->with('reviews')->get();

        $usersFiltered = [];
        
                foreach($users as $user){
                    foreach($user['instruments'] as $instrument){
                        if($instrument['slug'] == $slug)
                            if(count($user['reviews']) >= $rewMin){
                                $usersFiltered[] = $user;
                            }
                    }
        }

        return response()->json([
            'success' => true,
            'data' => $usersFiltered,
        ]);
    }
}
