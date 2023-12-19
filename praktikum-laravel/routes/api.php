<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Route;

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
Route::post("/v1/register", [AuthController::class,'register']);
Route::post("/v1/login", [AuthController::class,'login']);
Route::get("/v1/user/{id}",  [AuthController::class, 'getUserById']);
Route::get("/v1/user",  [AuthController::class, 'showAllUsers']);
Route::delete("v1/delete/{id}", [AuthController::class, 'deleteUser']);
Route::put("/v1/update/{id}", [AuthController::class, 'updateUserById']);

Route::middleware('auth:sanctum')->get('/user', function (AuthRequest $request) {
    return $request->user();
});

Route::get("/v2/product/{id}",  [ProductController::class, 'show']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });