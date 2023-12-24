<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/indicators', [\App\Http\Controllers\Superadmin\IndicatorController::class, 'index']);
Route::post('/indicators/create', [\App\Http\Controllers\Superadmin\IndicatorController::class, 'store']);
Route::get('/package', [\App\Http\Controllers\PackageController::class, 'index']);
Route::get('/ppk', [\App\Http\Controllers\Superadmin\PPKController::class, 'index']);
Route::get('/accessor-ppk', [\App\Http\Controllers\AccessorPpkController::class, 'index']);
Route::post('/accessor-ppk/create', [\App\Http\Controllers\AccessorPpkController::class, 'store']);
Route::get('/vendor', [\App\Http\Controllers\VendorController::class, 'index']);
Route::post('/vendor/create', [\App\Http\Controllers\VendorController::class, 'store']);
Route::get('/accessor', [\App\Http\Controllers\AccessorController::class, 'index']);
Route::post('/accessor/create', [\App\Http\Controllers\AccessorController::class, 'store']);

Route::post('/login', [\App\Http\Controllers\AuthController::class,'login']);
