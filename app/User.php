<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','telephone','subscribed','date_subscription','messages','paiement',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*Relation Paiment & Message*/

    public function Verification_paiement()
    {
        return $this->hasMany('App\Verification_paiement', 'user_id', 'id');
    }

     public function Messages_user()
    {
        return $this->hasMany('App\Messages_user', 'user', 'id');
    }
}