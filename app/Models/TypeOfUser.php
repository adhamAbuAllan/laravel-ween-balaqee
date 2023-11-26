<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypeOfUser extends Model
{
    use HasFactory;


//model
    protected $fillable = [
        'id',
        'name',
        'active',
    ];
    protected $table = "type_of_users";
    public function users():HasMany{
        return $this->hasMany(User::class);
    }

}
