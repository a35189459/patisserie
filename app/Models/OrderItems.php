<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// 訂單細項相關資料表
class OrderItems extends Model
{
    use HasFactory;

    // 表名
    protected $table = 'order_items';

    // 主鍵
    protected $primaryKey = 'order_item_id';
    
    public $timestamps = false;

    // 可以被批量賦值的屬性
    protected $fillable = ['order_id','product_id','product_name','price','quantity','total_price'];
    
}