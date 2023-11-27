<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
