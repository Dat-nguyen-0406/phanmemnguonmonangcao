<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Tên bảng trong database
    protected $table = 'categories';


    protected $fillable = [
        'name',
        'description',
        'image',
        'parent_id',
        'is_active',
        'is_delete'
    ];

    
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_delete', 0);
    }
}