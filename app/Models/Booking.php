<?php

namespace App\Models;
use App\Models\Apartment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;
//don't delete it
//$start_date = date("Y-m-d");
//echo "<br/>";
//$to_date = date("Y-m-d", strtotime("+24 months"));
//echo $to_date;

    protected $fillable = [
        'id',
        'apartment_id',
        'user_id',
        'price',
        'from_date',
        'to_date',
        'total_price',
        'is_booking',
        'month_count',
        'current_date',
        'active',
    ];
    protected $casts = [
        'apartment_id' => 'integer',
        'user_id' => 'integer',
        'total_price' => 'integer',
        'price' => 'integer',
        'month_count' => 'integer',
        'active' => 'integer',

    ];

    protected $table = "bookings";


  public function user(): BelongsTo
  {
      return $this->belongsTo(Apartment::class,);

  }

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class,);
    }
}
