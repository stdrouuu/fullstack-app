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
        if ($tableNumber) {
            Session::put('tableNumber', $tableNumber); //simpan ke session
        }

        $items = Item::where('is_active', 1)->orderBy('name', 'asc')->get(); 
        //ambil data yang is_active/1 + urutkan berdasarkan name secara ascending

        return view('customer.menu', compact('items', 'tableNumber')); //kirim data items ke view customer.menu
    }

    public function cart() //untuk menyimpan data cart di session pada saat customer menekan tombol add to cart
    {
        $cart = Session::get('cart');
        return view('customer.cart', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $menuId = $request->input('id'); //ambil id dari request
        $menu = Item::find($menuId); //cari menu berdasarkan id

        if (!$menu) {
            return response()->json([
                'status' => 'error',
                'message' => 'Menu tidak ditemukan'
            ]);
        }

        $cart = Session::get('cart', []);
        

        //cek apakah cart kosong atau tidak
        if(isset($cart[$menuId])) { 
            $cart[$menuId]['qty'] += 1;
        } else {
            $cart[$menuId] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'price' => $menu->price,
                'image' => $menu->img,
                'qty' => 1
            ];
        }

        Session::put('cart', $cart);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil ditambahkan ke keranjang',
            'cart' => $cart
        ]);
    }

    public function updateCart(Request $request)
    {
        $itemId = $request->input('id');
        $newQty = $request->input('qty');

        if ($newQty <= 0) {
            return response()->json([
                'success' => false
            ]);
        }

        $cart = Session::get('cart');
        if (isset($cart[$itemId])) {
            $cart[$itemId]['qty'] = $newQty;
            Session::put('cart', $cart);
            Session::flash('success', 'Jumlah item berhasil diperbarui');

            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }

    public function removeCart(Request $request)
    {
        $itemId = $request->input('id');
        $cart = Session::get('cart');

        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            Session::put('cart', $cart);

        Session::flash('danger', 'Item berhasil dihapus dari keranjang');

        return response()->json([
            'success' => true
        ]);
        }
    }   

    public function clearCart()
    {
        Session::forget('cart');
        return redirect()->route('cart')->with('danger', 'Keranjang berhasil dikosongkan');
    }
}
