<?php

use App\Http\Controllers\API\DashboardController;
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

Route::get('get-weather-history', [DashboardController::class, 'getWeatherHisty']);

Route::get('get-temperature', [DashboardController::class, 'getTemperature']);
Route::get('get-wind', [DashboardController::class, 'getWind']);
Route::get('get-humidity', [DashboardController::class, 'getHumidity']);
Route::get('get-weather-reports', [DashboardController::class, 'getWeatherReports']);
