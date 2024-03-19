<?php

namespace App\Http\Repositories\User;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Config\Repository;


class UserRepo extends Repository
{
    // 會員資料
    public function info($user_id)
    {
        $userData = User::where('user_id',$user_id)->first();

        return response()->json([
            'message' => '使用者資訊連線成功',
            'userData' => $userData,
        ], 200);
    }

    // 會員資料
    public function contact($request)
    {
        // 如果請求通過驗證，則創建合作資訊
        Contact::create([
            'contact_person'=>$request['contact_person'],
            'contact_phone'=>$request['contact_phone'],
            'contact_email'=>$request['contact_email'],
            'letter_title'=>$request['letter_title'],
            'letter_content'=>$request['letter_content'],
        ]);
        return response()->json([
            'message' => '資料新增成功',
        ], 200);
    }

}