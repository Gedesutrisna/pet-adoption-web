<?php

namespace App\Models;

use App\Models\User;
use App\Models\Shelter;
use App\Models\Adoption;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Donate extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function adoption(){
        return $this->belongsTo(Adoption::class);
    }
    public function shelter(){
        return $this->belongsTo(Shelter::class);
    }
    public function campaign(){
        return $this->belongsTo(Campaign::class);
    }

}
