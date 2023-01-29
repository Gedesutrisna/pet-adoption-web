<?php

namespace App\Models;

use App\Models\User;
use Ramsey\Uuid\Uuid;
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
    public function scopeFilter($query, array $filters)
{
    $query->when($filters['search'] ?? false, function ($query, $search) {
        return $query->where('adoption_id', 'like', '%' . $search . '%')
            ->orWhere('shelter_id', 'like', '%' . $search . '%')
            ->orWhere('campaign_id', 'like', '%' . $search . '%');
    });

}
    //uuid
    public $incrementing = false;
    protected $keyType = 'string';
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
        });
    }


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




    public function totalAmount()
    {
        return $this->sum('amount');
    }
    public function totalAmountByCampaign($campaign_id)
    {
        return $this->where('campaign_id', $campaign_id)->sum('amount');
    }
    public function totalAmountByAdoption($adoption_id)
    {
        return $this->where('adoption_id', $adoption_id)->sum('amount');
    }
    public function totalAmountByShelter($shelter_id)
    {
        return $this->where('shelter_id', $shelter_id)->sum('amount');
    }


}
