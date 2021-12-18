<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sponsorship;
use App\User;

class SponsorshipController extends Controller
{
    public function index(User $user)
    {

        $user = Auth::user();

        $userSponsor = User::where('id', $user->id)->with('sponsorships')->get();
        // dd($userSponsor);
        $prova = $userSponsor[0]['sponsorships'];
        // return response()->json([
        //     'data' => $prova
        // ]);
        $sponsorships = Sponsorship::all();
        
        
        return view('admin.sponsor.index', compact('sponsorships', 'prova'));
    }
}
