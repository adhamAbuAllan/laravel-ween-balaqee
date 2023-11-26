<?php

namespace App\Models;

use Cassandra\Cluster\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
/**
 * @mixin Builder
 */
class University extends Model
{

    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'active',


    ];
    protected $table = "universities";

    public function users():HasMany{
        return $this->hasMany(User::class);
    }
}
