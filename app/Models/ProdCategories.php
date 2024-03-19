<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 產品種類相關資料表
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdCategories extends Model
{
    use HasFactory;

    // 表名
    protected $table = 'prod_categories';

    // 主鍵
    protected $primaryKey = 'category_id';

    // 可以被批量賦值的屬性
    protected $fillable = ['name'];

    // 產品與分類之間的關聯
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}