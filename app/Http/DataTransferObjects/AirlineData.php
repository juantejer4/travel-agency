<?php

namespace App\Http\DataTransferObjects;

class AirlineData
{
    /**@param array<int, string> $cities */
    public function __construct(public string $name, public string $description, public array $cities){

    }
}
