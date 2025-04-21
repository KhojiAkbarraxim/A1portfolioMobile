<?php

use App\Http\Controllers\ITB\AnnouncementController;
use App\Http\Controllers\OrganizationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the 'api' middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/telegram/hook',[App\Http\Controllers\TelegramController::class, 'handle']);

Route::resource('announcement',AnnouncementController::class);
Route::resource('organization',OrganizationController::class);
