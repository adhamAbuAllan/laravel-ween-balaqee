<?php

namespace App\Models;

use App\Models\Advantage;
use ApartmentAdvantages;
use Apartments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apartment_Advantage extends Model
{
    use HasFactory;
    protected  $fillable = [
        'id',
        'apartment_id',
        'advantage_id',
    ];

    protected $table = "apartment_advantages";

    public function apartments_advantages():BelongsTo
    {
        return $this->belongsTo(ApartmentAdvantages::class);
    }

    public function apartments(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Apartments::class,);
    }

    public function advantages():BelongsTo{
        return $this->belongsTo(Advantage::class,);
    }

}
