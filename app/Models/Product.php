<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'price',
        'image',
        'quantity',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
