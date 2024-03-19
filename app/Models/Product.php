<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// 產品相關資料表
class Product extends Model
{
    use HasFactory;

    // 表名
    protected $table = 'products';

    // 主鍵
    protected $primaryKey = 'prod_id';

    // 可以被批量賦值的屬性
    protected $fillable = ['prod_name', 'description', 'price', 'quantity', 'category_id', 'image_url'];
}