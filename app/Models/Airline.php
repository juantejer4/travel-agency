<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Airline extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded = [];

    public function cities() : BelongsToMany
    {
        return $this->belongsToMany(City::class, 'airline_city', 'city_id', 'airline_id');
    }
}
