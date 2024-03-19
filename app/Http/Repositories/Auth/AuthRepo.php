<?php

namespace App\Http\Repositories\Auth;

use App\Models\User;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthRepo extends Repository
{
    
    // 註冊
    public function register($allRequest ,$name ,$email ,$phone,$password)
    {
        // 定義驗證規則
        $rules = [
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string|email|max:255|unique:users',
            'user_password' => 'required|string|min:6',
            'user_phone' => 'required|string|min:10|max:15|unique:users', // 電話號碼是 10 到 15 個數字的字符串，並且在 users 表中是唯一的
        ];

        // 驗證請求
        $validator = Validator::make($allRequest, $rules);

        // 如果驗證失敗
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        
        // 如果請求通過驗證，則創建新用戶記錄
        $user = User::create([
            'user_name' => $name,
            'user_email' => $email,
            'user_phone' => $phone,
            'user_password' => Hash::make($password),
        ]);
        
        // 返回成功註冊的消息
        return response()->json(['message' => '註冊成功'], 201);

    }

    // 登入
    public function login($request)
    {
        $credentials = $request->only('user_email', 'user_password');
        $user = User::where('user_email', $credentials['user_email'])->first();

        // 使用者不存在
        if (!$user) {
            return response()->json(['error' => '使用者不存在'], 404);
        }

        // 密碼錯誤
        if (!Hash::check($credentials['user_password'], $user->user_password)) {
            return response()->json(['error' => '密碼錯誤'], 401);
        }

        // 認證成功，將用戶登入
        Auth::login($user);

        // 確認使用者是否登入
        if (Auth::check()) {
            $user = Auth::user();

            return response()->json([
                'message' => '登入成功!',
                'loggedIn' => true,
                'user' => $user,
            ], 200);
            
        } else {
            return response()->json(['error' => '登入失敗，請聯繫客服人員處理'], 401);
        }
    }

    
    // 登出
    public function logout($request)
    {
        Auth::logout();
        return response()->json([
            'message' => '登出成功',
            'loggedOut' => true,
        ], 200);
    }


}