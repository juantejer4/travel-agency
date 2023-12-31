<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flight extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function origin() : BelongsTo
    {
        return $this->belongsTo(City::class, 'origin_city_id');
    }
    public function destination() : BelongsTo
    {
        return $this->belongsTo(City::class, 'destination_city_id');
    }
    public function airline() : BelongsTo
    {
        return $this->belongsTo(Airline::class);
    }
}

