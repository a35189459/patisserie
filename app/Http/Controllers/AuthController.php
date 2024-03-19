<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Auth\AuthService;




class AuthController extends Controller
{
    protected $AuthService;

    public function __construct(AuthService $AuthService)
    {
        $this->AuthService = $AuthService;
    }

    // 註冊
    public function register(Request $request)
    {
        $name = $request->user_name;
        $email = $request->user_email;
        $password = $request->user_password;
        $phone = $request->user_phone;
        $allRequest = $request->all();

        $registerRespone = $this->AuthService->register($allRequest,$name,$email,$phone,$password);  
        
        return $registerRespone;
    }

    // 登入
    public function login(Request $request)
    {
        $loginRespone = $this->AuthService->login($request);
        
        return $loginRespone;

    }

    // 登出
    public function logout(Request $request)
    {
        $logoutRespone = $this->AuthService->logout($request);
        
        return $logoutRespone;
    }

}