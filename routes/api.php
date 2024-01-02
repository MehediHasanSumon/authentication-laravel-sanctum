<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;

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
Route::prefix('/user')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/register', [UserController::class, 'user_register']);
    Route::post('/login', [UserController::class, 'user_login']);
    Route::post('/password-reset', [PasswordResetController::class, 'send_reset_mail']);
    Route::post('/reset/{token}', [PasswordResetController::class, 'reset_password']);

});

Route::middleware('auth:sanctum')->prefix('/user')->group(function () {
    Route::post('/logout', [UserController::class, 'user_logout']);
    Route::post('/user_change_password', [UserController::class, 'user_change_password']);
});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
