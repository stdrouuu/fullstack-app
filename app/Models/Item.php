<?php

// php artisan make:model Item -m

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use softDeletes, hasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'category_id',
        'img',
        'is_active', 
        'created_at', 
        'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class); 
        //relasi many to one, dari tabel items ke tabel category
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class); 
        //relasi one to many, dari tabel items ke tabel order_items
    }
}
