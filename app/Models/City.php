<?php

namespace App\Models;

use Apartments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;
    protected  $fillable = [
        'id',
        'name',
        'active',

    ];
    protected $table = "cities";

    public function users():HasMany{
        return $this->hasMany(User::class);
    }

    public function apartment():HasMany{
        return $this->hasMany(Apartments::class);
    }
}
