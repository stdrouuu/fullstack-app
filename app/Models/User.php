<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, softDeletes;

    protected $fillable = [
        'username',
        'password',
        'full_name',
        'email',
        'phone',
        'role_id',
        'created_at',
        'updated_at'
    ];

    protected $dates = ['deleted_at'];

    public function role()
    {
        return $this->belongsTo(Role::class); 
        //relasi many to one, dari tabel users ke tabel roles
    }

    public function orders()
    {
        return $this->hasMany(Order::class); 
        //relasi one to many, dari tabel users ke tabel orders
    }
}
