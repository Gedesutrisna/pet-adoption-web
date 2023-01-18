<?php

namespace App\Models;

use App\Models\Pet;
use App\Models\Campaign;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function Pet(){
        return $this->hasMany(Pet::class);
    }
    public function campaign(){
        return $this->hasMany(Campaign::class);
    }

}
