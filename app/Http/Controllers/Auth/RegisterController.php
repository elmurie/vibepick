<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //Modifica del register controller default conseguente alla modifica della tabella users
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'profile_pic' => ['string', 'max:255'],
            'phone_number' => ['numeric', 'digits_between:10, 16'],
            'instruments' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'genre' => ['string', 'max:255'],
            'services' => ['text']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //Modifica del default di laravel per consentire l'attach
        $newUser = new User();
        $newUser->firstname = $data['firstname'];
        $newUser->lastname = $data['lastname'];
        $newUser->address = $data['address'];
        $newUser->phone_number = $data['phone_number'];
        $newUser->email = $data['email'];
        $newUser->password = Hash::make($data['password']);
        $newUser->save();
        //attachment relativo alla many to many con gli strumenti
        $newUser->instruments()->attach($data['instruments']);
        return $newUser;
    }
}
