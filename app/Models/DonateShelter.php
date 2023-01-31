<?php

namespace App\Models;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Shelter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonateShelter extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    public function scopeFilter($query, array $filters)
{
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('shelter_id', 'like', '%' . $search . '%');
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

    public function shelter(){
        return $this->belongsTo(Shelter::class);
    }

    public function totalAmount()
    {
        return $this->sum('amount');
    }}
