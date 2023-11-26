<?php

namespace App\Models;

use Apartments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class upload extends Model
{
    use HasFactory;
    protected $fillable =[
        'image_name',
//        'apartment_id',
//        'photo_id'
    ];

    public function setFilenamesAttribute($value){
        $this->attributes['image_name']=json_encode($value);
    }
    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartments::class, 'apartment_id', 'id');
    }

}
