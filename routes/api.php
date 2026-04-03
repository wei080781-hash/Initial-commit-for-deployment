<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 1. 會員註冊 (POST /api/register)
Route::post('/register', [AuthController::class, 'register']);

// 2. 會員登入 (POST /api/login)
Route::post('/login', [AuthController::class, 'login']);

// 3. 需要驗證的路由 (例如登出、獲取使用者資料)
Route::middleware('auth:sanctum')->group(function () {
    // 獲取目前登入會員資料 (GET /api/user)
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // 會員登出 (POST /api/logout)
    Route::post('/logout', [AuthController::class, 'logout']);
});
