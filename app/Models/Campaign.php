<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\campaignDonate;
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
    public function campaignDonate(){
        return $this->hasMany(CampaignDonate::class);
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
        $this->with('campaignDonate');
        $total_donation = $this->campaignDonate->where('status', 'Paid')->sum('amount');

        if($total_donation == $this->donation_target || $this->date_target <= now()){
            $this->update(['status' => 'Completed']);
        }
        return round($total_donation / $this->donation_target * 100, 2);
    }
    
    public function remaining()
    {
        $this->with('campaignDonate');
        $total_donation = $this->campaignDonate->where('status', 'Paid')->sum('amount');
        return number_format($this->donation_target - $total_donation);
    }


}
