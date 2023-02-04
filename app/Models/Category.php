<?php

namespace App\Models;

use App\Models\Pet;
use App\Models\Shelter;
use App\Models\Adoption;
use App\Models\Campaign;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = [
        'id'
    ];
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('slug', 'like', '%' . $search . '%');
        });
        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            }
            );
        });
    }


    public function pet(){
        return $this->hasMany(Pet::class);
    }
    public function campaign(){
        return $this->hasMany(Campaign::class);
    }
    public function shelter(){
        return $this->hasMany(Shelter::class);
    }
    public function adoption(){
        return $this->hasMany(Adoption::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }
}
