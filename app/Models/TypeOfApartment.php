<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use TypeOfApartments;

class TypeOfApartment extends Model
{

    use HasFactory;
    protected $fillable = [
        'name',
        'active',
    ];
    public $table = "type_of_apartments";

//    public function type_of_apartments(): BelongsTo
//    {
//        return $this->belongsTo(TypeOfApartments::class);
//    }

//    public function university():BelongsTo{
//        return $this->belongsTo(Apartment::class,'apartment');
//    }



}
