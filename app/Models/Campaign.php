<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\Donate;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Campaign extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [
        'id'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('body', 'like', '%' . $search . '%');
        });
        $query->when($filters['category'] ?? false, function ($query, $category) {
            return $query->whereHas('category', function ($query) use ($category) {
                $query->where('slug', $category);
            }
            );
        });
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function donate(){
        return $this->hasMany(Donate::class);
    }
    public function admin(){
        return $this->belongsTo(Admin::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }

    public function percentage()
    {
        $total_donation = Donate::where('campaign_id', $this->id)->sum('amount');
    
        if($total_donation == $this->donation_target || $this->date_target <= now()){
            $this->update(['status' => 'completed']);
        }
        return round($total_donation / $this->donation_target * 100, 2);
    }
    public function remaining()
{
    $total_donation = Donate::where('campaign_id', $this->id)->sum('amount');
    return number_format($this->donation_target - $total_donation);
}

    

}
