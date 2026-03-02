<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Tên bảng trong database (mặc định Laravel sẽ hiểu là 'products')
    protected $table = 'products';

    /**
     * Các thuộc tính có thể gán hàng loạt (Mass Assignable).
     * Dựa trên Controller của bạn, chúng ta cần các trường: name, price, stock.
     */
    protected $fillable = [
        'name',
        'price',
        'stock',
    ];

    /**
     * Tự động ép kiểu dữ liệu khi lấy ra từ database.
     */
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];
}