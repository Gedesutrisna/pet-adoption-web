<?php

namespace App\Models;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Adoption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdoptionDonate extends Model
{
    use HasFactory;
    protected $guarded = [
        'id'
    ];
    public function scopeFilter($query, array $filters)
{
    $query->when($filters['search'] ?? false, function ($query, $search) {
        return $query->join('users', 'users.id', '=', 'adoption_donates.user_id')
        ->where('users.name', 'like', '%' . $search . '%')
        ->orWhere('users.email', 'like', '%' . $search . '%');
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
}
