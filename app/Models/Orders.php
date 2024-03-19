<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// 訂單相關資料表
class Orders extends Model
{
    use HasFactory;

    // 表名
    protected $table = 'orders';

    // 主鍵
    protected $primaryKey = 'order_id';

    public $timestamps = false;

    // 可以被批量賦值的屬性
    protected $fillable = ['user_id','user_name','user_phone','user_email','payment_method','notes','amount','total_quantity'];
    
}