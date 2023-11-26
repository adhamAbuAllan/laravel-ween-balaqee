<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CityTest extends Model
{
    use HasFactory;
    protected  $fillable = [
        'id',
        'name',
        'active',

    ];
    public function apartment():HasMany{
        return $this->hasMany(ApartmentTest::class);
    }

}
