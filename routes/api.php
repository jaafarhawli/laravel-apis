<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApisController;

Route::get("/sort_string/{string?}", [ApisController::class, 'sortString']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
