<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Instrument;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if( $user->id != Auth::id() ) {
            abort("403");
        }    
        $instruments = Instrument::all();
        return view('admin.edit', compact('user', 'instruments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate(['genre' => 'string | required | max:100 ']);
        if( $user->id != Auth::id() ) {
            abort("403");
        }  
        $user->firstname = $user->firstname; 
        $user->lastname = $user->lastname;
        $user->address = $request->address;
        $user->profile_pic = $request->profile_pic;
        $user->phone_number = $request->phone_number;
        $user->email = $user->email;
        $user->genre = $request->genre;
        $user->password = $user->password;
        $user->services = $request->services;
        $user->save();

        $user->instruments()->sync($request->instruments);

        return view('admin.home', compact('user'));

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        if( $user->id != Auth::id() ) {
            abort("403");
        }
        
        $user->delete();

        return redirect()->route("homepage");
    }
}
