<?php

// php artisan make:model Order -m

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'user_id', 
        'subtotal', 
        'tax', 
        'grandtotal', 
        'status', 
        'table_number', 
        'payment_method', 
        'note', 
        'created_at', 
        'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class); 
        //relasi many to one, dari tabel orders ke tabel user
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class); 
        //relasi one to many, dari tabel orders ke tabel order_items
    }
}
