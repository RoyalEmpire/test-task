<?php

namespace App\Repositories;

use App\Models\MarkupCategory;
use App\Models\MarkupLocation;
use App\Models\MarkupQuantity;
use App\Models\MarkupUser;

class CalculateProductsRepository
{
    /**
     * @param string $category
     * @return MarkupCategory|null
     */
    public function getMarkupCategory(string $category): ?MarkupCategory
    {
        return MarkupCategory::query()
            ->whereName($category)
            ->first();
    }

    /**
     * @param string $location
     * @return MarkupLocation|null
     */
    public function getMarkupLocation(string $location): ?MarkupLocation
    {
        return MarkupLocation::query()
            ->where('city', $location)
            ->first();
    }

    /**
     * @param string $type
     * @return MarkupUser|null
     */
    public function getMarkupUser(string $type): ?MarkupUser
    {
        return MarkupUser::query()
            ->whereType($type)
            ->first();
    }

    /**
     * @param int $quantity
     * @return MarkupQuantity|null
     */
    public function getMarkupQuantity(int $quantity): ?MarkupQuantity
    {
        return MarkupQuantity::query()
            ->whereRaw('? between min_quantity and max_quantity', [$quantity])
            ->first();
    }
}
