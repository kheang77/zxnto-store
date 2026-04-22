<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Add item to cart
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $id    = $request->id;
        $name  = $request->name;
        $price = (float) $request->price;
        $img   = $request->img;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += max(1, (int)$request->qty);
        } else {
            $cart[$id] = [
                'name'  => $name,
                'price' => $price,
                'img'   => $img,
                'size'  => $request->size ?? '',
                'qty'   => max(1, (int)$request->qty),
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', '"' . $name . '" added to cart.');
    }

    // Remove one item
    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->id]);
        session()->put('cart', $cart);
        return back();
    }

    // Update quantity
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $id   = $request->id;
        $qty  = (int) $request->qty;

        if ($qty <= 0) {
            unset($cart[$id]);
        } else {
            $cart[$id]['qty'] = $qty;
        }

        session()->put('cart', $cart);
        return back();
    }

    // Clear entire cart
    public function clear()
    {
        session()->forget('cart');
        return back();
    }

    // Show cart page
    public function index()
    {
        $cart  = session()->get('cart', []);
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        return view('cart', compact('cart', 'total'));
    }
}
