<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\User\UserService;



class UserController extends Controller
{
    protected $UserService;

    public function __construct(UserService $UserService)
    {
        $this->UserService = $UserService;
    }

    // 會員資料
    public function info(Request $request)
    {
        $user_id = $request->user_id;
    
        $infoRespone = $this->UserService->info($user_id);
        
        return $infoRespone;
    }

    // 會員資料
    public function contact(Request $request)
    {
        $request = $request->all();
    
        $respone = $this->UserService->contact($request);
        
        return $respone;
    }
}