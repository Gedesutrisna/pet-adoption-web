<?php

namespace App\Models;

use App\Models\Pet;
use App\Models\User;
use App\Models\Category;
use App\Models\AdoptionDonate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adoption extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->join('users', 'users.id', '=', 'adoptions.user_id')
            ->where('users.name', 'like', '%' . $search . '%')
            ->orWhere('users.email', 'like', '%' . $search . '%');
        });
        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            }
            );
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function pet(){
        return $this->belongsTo(Pet::class);
    }
    public function adoptionDonate(){
        return $this->hasMany(AdoptionDonate::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function approve()
    {
        $this->status = 'approved';
        $this->save();
    }
    public function decline()
    {
        $this->status = 'declined';
        $this->save();
    }
}
