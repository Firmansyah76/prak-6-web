<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Requests\AuthRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('register'); // Gantilah 'register' dengan nama view yang sesuai
});

Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', function () {
    return view('login'); // Gantilah 'login' dengan nama view yang sesuai
});

Route::post('/login', [AuthController::class, 'login']);