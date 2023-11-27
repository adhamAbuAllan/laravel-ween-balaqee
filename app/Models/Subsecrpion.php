<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsecrpion extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "documentary_photo",
        "payment_status",
        "start_date",
        "end_date",
        "plan_id",
        "user_id",
        "created_at",
    ];


}
