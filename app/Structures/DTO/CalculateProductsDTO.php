<?php

namespace App\Structures\DTO;

class CalculateProductsDTO
{
    public function __construct(
        public string $userType,
        public float $basePrice,
        public string $location,
        public string $category,
        public int $quantity,
    ) {
    }

    public function toArray(): array
    {
        return array_filter([
            'userType' => $this->userType,
            'basePrice' => $this->basePrice,
            'location' => $this->location,
            'category' => $this->category,
            'quantity' => $this->quantity,
        ]);
    }
}
