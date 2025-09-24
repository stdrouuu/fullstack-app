<?php

// php artisan make:model OrderItem -m

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use softDeletes;

    protected $fillable = [
        'order_id', 
        'item_id', 
        'quantity', 
        'price',
        'tax', 
        'total_price', 
        'created_at', 
        'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function order()
    {
        return $this->belongsTo(Order::class); 
        //relasi many to one, dari tabel order_items ke tabel orders
    }

    public function item()
    {
        return $this->belongsTo(Item::class); 
        //relasi many to one, dari tabel order_items ke tabel items
    }
}
