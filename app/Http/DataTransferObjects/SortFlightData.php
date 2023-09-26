<?php

namespace App\Http\DataTransferObjects;

class SortFlightData
{
    public function __construct(
        public ?string $sort,
        public ?string $sortOrder,
        public ?string $startDate,
        public ?string $endDate
    ) {
    }
}

