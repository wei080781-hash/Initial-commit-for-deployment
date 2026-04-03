<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * 會員註冊邏輯
     */
    public function register(Request $request)
    {
        // 1. 驗證資料格式
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => '驗證失敗',
                'errors' => $validator->errors()
            ], 422);
        }

        // 2. 建立新使用者
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // 密碼加密
        ]);

        // 3. 回傳成功資訊
        return response()->json([
            'status' => 'success',
            'message' => '註冊成功！',
            'user' => $user
        ], 201);
    }

    /**
     * 會員登入邏輯
     */
    public function login(Request $request)
    {
        // 1. 驗證登入資料
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. 嘗試驗證使用者身分
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // 生成 API Token (Sanctum)
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'message' => '登入成功！',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user
            ]);
        }

        // 3. 驗證失敗回傳錯誤
        return response()->json([
            'status' => 'error',
            'message' => '電子郵件或密碼錯誤'
        ], 401);
    }

    /**
     * 會員登出邏輯
     */
    public function logout(Request $request)
    {
        // 刪除目前的 Access Token
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => '已成功登出'
        ]);
    }
}
