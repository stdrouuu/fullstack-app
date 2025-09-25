<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('customer.menu');
});

Route::get('/cart', function () {
    return view('customer.cart');
})->name('cart');