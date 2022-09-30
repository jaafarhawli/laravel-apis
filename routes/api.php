<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApisController;

Route::get("/sort_string/{string?}", [ApisController::class, 'sortString']);

Route::get("/num_to_array/{num?}", [ApisController::class, 'numToArray']);

Route::get("/num_to_binary/{string?}", [ApisController::class, 'numToBinary']);

Route::get("/prefix/{prefix?}", [ApisController::class, 'prefix']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
