<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Instrument;
use App\Review;


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
        $instrument = Instrument::where('slug', $slug )->with('users')->first();
        $reviews = Review::all();

        
        
        foreach ($instrument['users'] as $user) {
            $user['reviews'] = [];
            $i = 0;
                foreach ($reviews as $review) {
                    if($review['user_id'] == $user['id']) {
                        $user['reviews'] += [$i => $review];
                        $i++;
                    }
                };
            };
            
        // dd($instrument['users']);
        // dd(count($user['reviews']));

        $prova = [];
        foreach ($instrument['users'] as $user) {

            if(count($user['reviews']) > $rewMin){
                $prova[] =  $user;
            }
        }

        return response()->json([
            'success' => true,
            'data' => $prova,
        ]);
    }
}
