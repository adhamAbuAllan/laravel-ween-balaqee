<?php

namespace App\Models;

use ApartmentAdvantages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Advantage extends Model
{
    use HasFactory;
    protected  $fillable = [
        'id',
        'adv_name',
        'checked_id',
        'icon'
    ];
    protected $table = "advantages";
    protected $hidden = ['created_at', 'updated_at'];
//for testing
    public function apartments(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Apartment::class, 'apartment_advantages');
    }




//    public function apartments_advantages(): HasMany
//    {
//        return $this->hasMany(ApartmentAdvantages::class);
//    }
//    public function apartments(): BelongsTo
//    {
//        return $this->belongsTo(Apartment::class);
//    }



}
