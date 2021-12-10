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

    public function show($slug)
    {
        $instrument = Instrument::where('slug', $slug )->with('users')->first();
        $reviews = Review::all();

        foreach ($reviews as $review) {
            foreach ($instrument['users'] as $user) {
                if($review['user_id'] == $user['id']) {
                    $user['reviews'] .= $review ;
                }
            };
        };



        return response()->json([
            'success' => true,
            'data' => $instrument
        ]);
    }
}
