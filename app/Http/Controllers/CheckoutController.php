<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect('/cart');

        $total = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));
        return view('checkout', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect('/cart');

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string',
            'payment' => 'required|in:cash,aba,wing,acleda',
        ]);

        $total = array_sum(array_map(fn($i) => $i['price'] * $i['qty'], $cart));

        $order = Order::create([
            'order_number'     => 'ORD-' . strtoupper(uniqid()),
            'customer_name'    => $request->name,
            'customer_email'   => $request->email,
            'customer_phone'   => $request->phone,
            'customer_address' => $request->address,
            'payment_method'   => $request->payment,
            'items'            => $cart,
            'total'            => $total,
            'status'           => 'pending',
            'note'             => $request->note,
        ]);

        session()->forget('cart');

        return redirect('/checkout/success/' . $order->order_number);
    }

    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->firstOrFail();
        return view('checkout_success', compact('order'));
    }
}
