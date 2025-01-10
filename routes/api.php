<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AnnonceController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\CarModelController;
use App\Http\Controllers\API\ConversationController;
use App\Http\Controllers\API\ConversationStateController;
use App\Http\Controllers\API\FavoriteController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('annonces', AnnonceController::class);
Route::apiResource('brands', BrandController::class);
Route::apiResource('carmodels', CarModelController::class);
Route::apiResource('conversations', ConversationController::class);
Route::apiResource('conversationstates', ConversationStateController::class);
Route::apiResource('favorites', FavoriteController::class);
Route::apiResource('images', ImageController::class);
Route::apiResource('messages', MessageController::class);
Route::apiResource('roles', RoleController::class);
Route::apiResource('users', UserController::class);
