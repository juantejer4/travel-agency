<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name'];

    public function airlines() : BelongsToMany
    {
        return $this->belongsToMany(Airline::class, 'airline_city', 'airline_id', 'city_id') ;
    }

    public function arrivingFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'destination_city_id');
    }
    
    public function departingFlights(): HasMany
    {
        return $this->hasMany(Flight::class, 'origin_city_id');
    }
    


}
