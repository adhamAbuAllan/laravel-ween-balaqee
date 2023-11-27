<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubsecrpionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "type",
        "description",
        "price",
        "created_at",
        "updated_at",
    ];

public  function subscription():HasMany{
    return $this->hasMany(Subsecrpion::class);
}

}

