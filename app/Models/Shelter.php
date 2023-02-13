<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use App\Models\DonateShelter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shelter extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->join('users', 'users.id', '=', 'shelters.user_id')
            ->where('users.name', 'like', '%' . $search . '%')
            ->orWhere('users.email', 'like', '%' . $search . '%');
        });
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function donateShelter(){
        return $this->hasMany(DonateShelter::class);
    }
    
    public function approve()
    {
        $this->status = 'Approved';
        $this->save();
    }
    public function decline()
    {
        $this->status = 'Declined';
        $this->save();
    }

    protected $attributes = [
        'status' => 'Inprogress'
    ];
}
