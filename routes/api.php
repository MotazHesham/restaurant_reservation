<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;


Route::post('login',[AuthenticationController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('check_availability', [TableController::class,'check_availability']);

    Route::post('reserve_table',[ReservationController::class,'reserve_table']);

    Route::get('list_menu_items',[MealController::class,'list_menu_items']);

    Route::post('order',[OrderController::class,'order']);
    Route::post('pay',[OrderController::class,'pay']);
});