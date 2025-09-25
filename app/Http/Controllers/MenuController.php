<?php

// php artisan make:controller MenuController

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Item;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $tableNumber = $request->query('meja'); //qris di meja ketika discan akan muncul query ?meja=7
        if(!$tableNumber) {
            Session::put('tableNumber', $tableNumber); //simpan ke session
        }

        $items = Item::where('is_active', 1)->orderBy('name', 'asc')->get(); 
        //ambil data yang is_active/1 + urutkan berdasarkan name secara ascending

        return view('customer.menu', compact('items', 'tableNumber')); //kirim data items ke view customer.menu
    }
}
