<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() 
    {
        return view('guest.homepage');
    }
    public function login() 
    {
        return view('auth.login');
    }
    public function register() 
    {
        return view('auth.register');
    }
}
