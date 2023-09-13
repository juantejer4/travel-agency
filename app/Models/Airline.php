<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airline extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function cities() : BelongsToMany
    {
        return $this->belongsToMany(City::class);
    }

    public function incomingFlights() : HasMany
    {
        return $this->hasMany(Flight::class);
    }
}
