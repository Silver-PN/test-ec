<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/users', [UserController::class, 'show']);
Route::get('/users/create', [UserController::class, 'create']);
Route::get('/users/{userId}/qrcode', [UserController::class, 'generateQrCode']);
Route::get('/status', [UserController::class, 'showStatus']);

Route::post('/login', [UserController::class, 'login']);
Route::post('/update-user/{id}', [UserController::class, 'update']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});