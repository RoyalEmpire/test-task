<?php

namespace App\Services;

use App\Structures\DTO\CalculateProductsDTO;
use App\Repositories\CalculateProductsRepository;

class CalculateProductsService
{
    private const EXCLUDED_KEYS = [
        'basePrice',
    ];

    public function __construct(private CalculateProductsRepository $calculateProductsRepository)
    {
    }

    /**
     * @param CalculateProductsDTO $data
     * @return array
     */
    public function calculate(CalculateProductsDTO $data): array
    {
        $finalPrice = $data->basePrice;
        $details = [];

        foreach ($data->toArray() as $key => $item) {
            if (in_array($key, self::EXCLUDED_KEYS, true)) {
                continue;
            }
            $finalPrice = match ($key) {
                'userType' => $this->applyUserDiscount($data->userType, $finalPrice, $details),
                'location' => $this->applyLocationDiscount($data->location, $finalPrice, $details),
                'category' => $this->applyCategoryDiscount($data->category, $finalPrice, $details),
                'quantity' => $this->applyQuantityDiscount($data->quantity, $finalPrice, $details),
            };
        }

        return [
            'details' => $details,
            'totalPrice' => round($finalPrice * $data->quantity, 2),
        ];
    }


    /**
     * @param string $category
     * @param float $finalPrice
     * @param array $details
     * @return float
     */
    protected function applyCategoryDiscount(string $category, float $finalPrice, array &$details)
    {
        $markupCategory = $this->calculateProductsRepository->getMarkupCategory($category);
        $markup = $markupCategory?->value ?? 0;
        $finalPrice += ($finalPrice * $markup / 100);
        $details[] = ($markup >= 0 ? "$markup% markup" : abs($markup) . "% discount") . " for $category applied.";

        return $finalPrice;
    }


    /**
     * @param string $location
     * @param float $finalPrice
     * @param array $details
     * @return float
     */
    protected function applyLocationDiscount(string $location, float $finalPrice, array &$details): float
    {
        $markupLocation = $this->calculateProductsRepository->getMarkupLocation($location);
        $markup = $markupLocation?->value ?? 0;
        $finalPrice += ($finalPrice * $markup / 100);
        $details[] = ($markup >= 0 ? "$markup% markup" : abs($markup) . "% discount") . " for $location applied.";

        return $finalPrice;
    }

    /**
     * @param int $quantity
     * @param float $finalPrice
     * @param array $details
     * @return float
     */
    protected function applyQuantityDiscount(int $quantity, float $finalPrice, array &$details): float
    {
        $markupQuantity = $this->calculateProductsRepository->getMarkupQuantity($quantity);
        $markup = $markupQuantity?->value ?? 0;
        $finalPrice += ($finalPrice * $markup / 100);
        $details[] = "{$markup}% volume discount applied for purchasing {$quantity} products.";

        return $finalPrice;
    }


    /**
     * @param string $userType
     * @param float $finalPrice
     * @param array $details
     * @return float
     */
    protected function applyUserDiscount(string $userType, float $finalPrice, array &$details): float
    {
        $markupUser = $this->calculateProductsRepository->getMarkupUser($userType);
        $markup = $markupUser?->value ?? 0;
        $finalPrice += ($finalPrice * $markup / 100);
        $details[] = "{$markup}% personal discount for the {$userType} applied.";

        return $finalPrice;
    }
}
