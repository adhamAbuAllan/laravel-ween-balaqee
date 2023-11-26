<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CityTest;

class ApartmentTest extends Model
{
    use HasFactory;
    protected  $fillable = [
        'id',
        'city_id',
        'owner_name'

];
    public function city(): BelongsTo
    {
        return $this->belongsTo(CityTest::class);
    }

}
