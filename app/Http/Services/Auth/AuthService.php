<?php

namespace App\Http\Services\Auth;

use App\Http\Repositories\Auth\AuthRepo;

class AuthService
{
    protected $AuthRepo;

    public function __construct(AuthRepo $AuthRepo)
    {
        $this->AuthRepo = $AuthRepo;
    }

    // 註冊
    public function register($allRequest,$name,$email,$phone,$password)
    {
        $registerRespone = $this->AuthRepo->register($allRequest,$name,$email,$phone,$password);

        return $registerRespone;
    }

    // 登入
    public function login($request)
    {
        $loginRespone = $this->AuthRepo->login($request);
        
        return $loginRespone;
    }

    
    // 登出
    public function logout($request)
    {
        $logoutRespone = $this->AuthRepo->logout($request);

        return $logoutRespone;
    }

}