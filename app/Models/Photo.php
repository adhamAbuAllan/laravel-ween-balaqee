<?php

namespace App\Models;

use Apartments;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Photos;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'apartment_id',
        'url',
        'active'
    ];
    protected $casts = [
        'apartment_id' => 'integer',
        'url' => 'array',

    ];
    public function setFilenamesAttribute($value){
        $this->attributes['url']=json_encode($value);
    }

    protected $table = "photos";

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartments::class);
    }
}













