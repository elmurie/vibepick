<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Instrument;


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

    public function show($name)
    {
        $instrument = Instrument::where('name', $name )->with('users')->first();

        return response()->json([
            'success' => true,
            'data' => $instrument
        ]);
    }
}
