<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class CountryPhoneNumber extends Model
{
    use HasFactory;
    protected  $fillable = [
        'id',
        'country_name',
        'country_phone_number',
        'flag'
    ];
    protected $table = "country_phone_numbers";
    protected $hidden = ['created_at', 'updated_at'];

    public function countryCodePhoneNumber(): BelongsTo{return $this->belongsTo(User::class,'country_phone_number_id','id');}
}
