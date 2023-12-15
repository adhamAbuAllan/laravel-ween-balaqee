<?php

namespace App\Models;

use App\Models\TypeOfUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\University;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'id',
        'name',
        'password',
//        'about_the_user',
        'phone',
//        'major',
        'country_phone_number_id',
        /*
          * be careful !!!
          * don't delete those two lines those tables of database
          * -------------------------------------------------
           'university_id',
            'type_id',
          * -------------------------------------------------
         */
        'type_id',
        'token',
//        'random_password',
//        'profile',
        'active',

        'created_at',


    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public $timestamps = true;
    public function subscribtions():HasMany{
        return $this->hasMany(Subsecrpion::class);
    }
    public function university():BelongsTo
    {
        return $this->belongsTo(University::class,"university_id","id");
    }
    public function type(): BelongsTo
    {
     return $this->belongsTo(TypeOfUser::class);//,"type_id","id");

    }
//    public function countryCodePhoneNumber(): BelongsTo{return $this->belongsTo(CountryPhoneNumber::class,'country_phone_number_id','id');}


}
