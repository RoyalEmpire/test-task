<?php

use App\Http\Controllers\Api\Products\CalculateProductsController;

Route::group(['prefix' => env('API_VERSION')], function () {
    Route::group(['prefix' => 'products'], function () {
        Route::post('/calculate', [CalculateProductsController::class, 'calculate']) ;
    });
});
