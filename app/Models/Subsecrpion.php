<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'updated_at',
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public  function subsecrpionPlan():BelongsTo{
        return $this->belongsTo(SubsecrpionPlan::class);
    }
}

