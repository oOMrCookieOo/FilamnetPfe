<?php

use App\Actions\Auth\AuthenticateAction;
use App\Actions\GetCategories;
use App\Actions\GetDiscountedProducts;
use App\Actions\GetNetWorkProducts;
use App\Actions\GetNewlyArrivedProducts;
use App\Actions\GetPrintersProducts;
use App\Actions\GetProductDetail;
use App\Actions\GetProducts;
use App\Actions\PlaceComment;
use App\Actions\PlaceOrder;
use App\Actions\SendNotif;
use App\Actions\StoreToken;
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
Route::get('GetNewlyArrivedProducts', GetNewlyArrivedProducts::class);
Route::get('GetOffers', GetDiscountedProducts::class);
Route::get('GetNewtWorkProducts', GetNetWorkProducts::class);
Route::get('GetPrinterProducts', GetPrintersProducts::class);
Route::get('products/{product}', GetProductDetail::class);
Route::get('products', GetProducts::class);
Route::post('order', PlaceOrder::class)->middleware('auth:sanctum');

Route::get('categories', GetCategories::class);
Route::post('comment', PlaceComment::class)->middleware('auth:sanctum');

Route::post('notifications', StoreToken::class);
Route::get('notifications', SendNotif::class);



