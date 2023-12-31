<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BranchController;

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
Route::get('/users', [UserController::class, 'showAll']);
Route::get('/users/{userId}', [UserController::class, 'show']);
Route::get('/users/create', [UserController::class, 'create']);
Route::get('/users/{userId}/qrcode', [UserController::class, 'generateQrCode']);
Route::get('/status', [UserController::class, 'showStatus']);
Route::get('/test', [UserController::class, 'showListStatusUsers']);

Route::post('/login', [UserController::class, 'login']);
Route::put('/update-user/{id}', [UserController::class, 'update']);
Route::post('/upload-file', [UserController::class, 'uploadFile']);
Route::get('avatar/{idUser}', [UserController::class, 'getAvatar']);
Route::post('/upload-degree', [UserController::class, 'uploadDegree']);
Route::get('degree/{idUser}', [UserController::class, 'getDegree']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('branches')->group(function () {
    Route::get('/', [BranchController::class, 'index']);
    Route::get('/{branch}', [BranchController::class, 'show']);
    Route::get('/check/{branch}', [BranchController::class, 'checkBranchExists']);
    Route::post('/search', [BranchController::class, 'search']);
    Route::post('/', [BranchController::class, 'store']);
    Route::put('/{branch}', [BranchController::class, 'update']);
    Route::delete('/{branch}', [BranchController::class, 'destroy']);
});