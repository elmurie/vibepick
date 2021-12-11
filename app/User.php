<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'address', 'profile_pic', 'phone_number', 'email', 'password', 'genre', 'services'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Many-to-Many tra strumenti e utenti
    public function instruments() {
        return $this->belongsToMany('App\Instrument');
    }

    // One-to-Many tra recensione e utenti
    public function reviews() {
        return $this->hasMany('App\Review');
    }

    // One-to-Many tra messaggi e utenti
    public function messages() {
        return $this->hasMany('App\Message');
    }

    // Many-to-Many tra sponsorship e utenti
    public function sponsorships() {
        return $this->belongsToMany('App\Sponsorship');
    }
}
