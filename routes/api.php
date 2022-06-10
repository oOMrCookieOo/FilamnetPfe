<?php

use App\Actions\Auth\AuthenticateAction;
use App\Actions\GetProducts;
use App\Actions\UpdateProfileAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('Auth', AuthenticateAction::class);
Route::get('User', function (Request $request) {
    return auth()->user();
})->middleware('auth:sanctum');

Route::post('Profile', UpdateProfileAction::class)->middleware('auth:sanctum');
Route::get('GetAllProduct', GetProducts::class);
