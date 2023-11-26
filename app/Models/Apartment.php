<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\TypeOfApartment;
use App\Models\City;
use App\Models\Apartment_Advantage;


class Apartment extends Model
{

    use HasFactory;

    protected $fillable = [
        'rooms',
        'bathrooms',
        'square_meters',
        'title',
        'description',
        'location',
        'price',
        'type',
        'city',
        'count_of_student',
//        'is_booking',
        'owner_id',

//        'images',
        'created_at',
        'phone',
        'active',
//        'first_image'
//    'advantages'


        /*
*Be careful !!
* don't delete those lines is important in future
-------------
        'city_id',
        'type_id',
--------------
*/


    ];
    protected $casts = [
        'rooms' => 'integer',
        'bathrooms' => 'integer',
        'square_meters' => 'integer',
        'price' => 'integer',
        'count_of_student' => 'integer',


    ];
    protected $table = "apartments";




    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function photo(): HasMany
    {
        return $this->hasMany(Photo::class);
    }
    public function upload(): HasMany
    {
        return $this->hasMany(upload::class,);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(TypeOfApartment::class);
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

//    public function advantage(): \Illuminate\Database\Eloquent\Relations\HasMany
//    {
//        return $this->hasMany(Apartment_Advantage::class,'apartment_id','id');
//    }


//for testing
    public function advantages(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Advantage::class, 'apartment_advantages');
    }

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class,);
    }


}
