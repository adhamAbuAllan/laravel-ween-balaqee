<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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


}
