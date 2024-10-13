<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CalculateProductsRequest;
use App\Services\CalculateProductsService;
use App\Structures\DTO\CalculateProductsDTO;
use Throwable;

class CalculateProductsController extends Controller
{
    public function __construct(private CalculateProductsService $calculateProductsService)
    {
    }

    /**
     * @param CalculateProductsRequest $request
     * @return JsonResponse
     */
    public function calculate(CalculateProductsRequest $request): JsonResponse
    {
        try {
            $dto = new CalculateProductsDTO(
                $request->get('userType'),
                $request->get('basePrice'),
                $request->get('location'),
                $request->get('category'),
                $request->get('quantity'),
            );

            $data = $this->calculateProductsService->calculate($dto);

            return response()->json([
                'message' => 'Price calculated successfully!',
                'details' => $data['details'],
                'totalPrice' => $data['totalPrice'],
            ]);
        } catch (Throwable $throwable) {
            \Log::error($throwable->getMessage());

            return response()->json([
                'message' => 'Price calculated failed!',
                'details' => [],
                'totalPrice' => [],
            ]);
        }
    }
}
