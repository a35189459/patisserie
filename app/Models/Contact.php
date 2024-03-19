<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 產品相關資料表
class Contact extends Model
{
    use HasFactory;

    // 表名
    protected $table = 'contact';

    // 主鍵
    protected $primaryKey = 'contact_id';

    // 可以被批量賦值的屬性
    protected $fillable = ['contact_person', 'contact_phone', 'contact_email', 'letter_title', 'letter_content'];
}