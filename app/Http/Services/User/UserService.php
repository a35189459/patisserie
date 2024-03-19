<?php

namespace App\Http\Services\User;

use App\Http\Repositories\Auth\AuthRepo;
use App\Http\Repositories\User\UserRepo;

class UserService
{
    protected $AuthRepo;
    protected $UserRepo;

    public function __construct(AuthRepo $AuthRepo,UserRepo $UserRepo)
    {
        $this->AuthRepo = $AuthRepo;
        $this->UserRepo = $UserRepo;
    }

    // 會員資料
    public function info($user_id)
    {
        $infoRespone = $this->UserRepo->info($user_id);
        
        return $infoRespone;
    }

    
    // 會員資料
    public function contact($request)
    {
        $respone = $this->UserRepo->contact($request);
        
        return $respone;
    }

}