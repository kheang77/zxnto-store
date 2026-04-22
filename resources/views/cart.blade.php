@extends('master')
@section('title', 'Cart â€” ZXNTO')

@section('head')
<style>
    .cart-page { max-width: 1000px; margin: 56px auto 100px; padding: 0 32px; }
    .cart-title { font-family: var(--font-head); font-size: 2.4rem; font-weight: 800; text-transform: uppercase; letter-spacing: -.01em; margin-bottom: 8px; }
    .cart-sub { color: var(--muted); font-size: .875rem; margin-bottom: 40px; }

    .cart-table { width: 100%; border-collapse: collapse; }
    .cart-table thead tr { border-bottom: 1px solid var(--border); }
    .cart-table th { font-size: .68rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .12em; padding: 0 0 16px; text-align: left; }
    .cart-table th:last-child { text-align: right; }
    .cart-table tbody tr { border-bottom: 1px solid var(--border); }
    .cart-table td { padding: 20px 0; vertical-align: middle; }

    .cart-item { display: flex; align-items: center; gap: 16px; }
    .cart-item-img { width: 72px; height: 72px; border-radius: var(--radius); overflow: hidden; background: var(--bg2); flex-shrink: 0; }
    .cart-item-img img { width: 100%; height: 100%; object-fit: cover; }
    .cart-item-name { font-family: var(--font-head); font-size: .95rem; font-weight: 700; text-transform: uppercase; }
    .cart-item-price { color: var(--muted); font-size: .82rem; margin-top: 4px; }

    .qty-form { display: flex; align-items: center; gap: 6px; }
    .qty-btn { width: 28px; height: 28px; border-radius: var(--radius); background: var(--surface); border: 1px solid var(--border2); color: var(--text); cursor: pointer; font-size: .8rem; display: flex; align-items: center; justify-content: center; transition: all .2s; }
    .qty-btn:hover { background: var(--gold); color: #0e0e0f; border-color: var(--gold); }
    .qty-input { width: 40px; text-align: center; background: var(--bg3); border: 1px solid var(--border2); border-radius: var(--radius); color: var(--text); font-family: var(--font-body); font-size: .875rem; padding: 4px; outline: none; }

    .remove-btn { background: none; border: none; color: var(--muted); cursor: pointer; font-size: .8rem; transition: color .2s; padding: 4px; }
    .remove-btn:hover { color: var(--red); }

    .cart-line-total { font-family: var(--font-head); font-size: 1rem; font-weight: 700; color: var(--gold); text-align: right; }

    .cart-footer { margin-top: 32px; display: flex; align-items: flex-start; justify-content: space-between; gap: 24px; flex-wrap: wrap; }
    .cart-summary { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 28px 32px; min-width: 280px; }
    .summary-row { display: flex; justify-content: space-between; font-size: .875rem; color: var(--muted); margin-bottom: 12px; }
    .summary-total { display: flex; justify-content: space-between; font-family: var(--font-head); font-size: 1.3rem; font-weight: 800; color: var(--text); padding-top: 16px; border-top: 1px solid var(--border); margin-top: 4px; }
    .summary-total span:last-child { color: var(--gold); }

    .empty-cart { text-align: center; padding: 80px 0; }
    .empty-cart i { font-size: 3.5rem; color: var(--border2); margin-bottom: 20px; display: block; }
    .empty-cart h3 { font-family: var(--font-head); font-size: 1.5rem; font-weight: 800; text-transform: uppercase; margin-bottom: 8px; }
    .empty-cart p { color: var(--muted); margin-bottom: 28px; }

    @media (max-width: 640px) {
        .cart-footer { flex-direction: column; }
        .cart-summary { width: 100%; }
    }
</style>
@endsection

@section('content')
<div class="cart-page">
    <div class="cart-title">Your Cart</div>
    <div class="cart-sub">{{ array_sum(array_column($cart, 'qty')) }} item(s) in your cart</div>

    @if(count($cart) > 0)
    <table class="cart-table">
        <thead>
            <tr>
                <th>Product</th>
                <th style="text-align:center">Quantity</th>
                <th style="text-align:right">Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $id => $item)
            <tr>
                <td>
                    <div class="cart-item">
                        <div class="cart-item-img">
                            <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=200&q=80'">
                        </div>
                        <div>
                            <div class="cart-item-name">{{ $item['name'] }}</div>
                            <div class="cart-item-price">
                                ${{ number_format($item['price'], 2) }} each
                                @if(!empty($item['size'])) Â· Size {{ $item['size'] }} @endif
                            </div>
                        </div>
                    </div>
                </td>
                <td style="text-align:center">
                    <form method="POST" action="/cart/update" class="qty-form" style="justify-content:center">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button type="submit" name="qty" value="{{ $item['qty'] - 1 }}" class="qty-btn"><i class="fas fa-minus"></i></button>
                        <input type="number" name="qty" value="{{ $item['qty'] }}" min="0" class="qty-input" onchange="this.form.submit()">
                        <button type="submit" name="qty" value="{{ $item['qty'] + 1 }}" class="qty-btn"><i class="fas fa-plus"></i></button>
                    </form>
                </td>
                <td class="cart-line-total">${{ number_format($item['price'] * $item['qty'], 2) }}</td>
                <td style="text-align:right">
                    <form method="POST" action="/cart/remove">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <button type="submit" class="remove-btn" title="Remove"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="cart-footer">
        <form method="POST" action="/cart/clear">
            @csrf
            <button type="submit" class="btn btn-ghost"><i class="fas fa-trash"></i> Clear Cart</button>
        </form>

        <div class="cart-summary">
            <div class="summary-row"><span>Subtotal</span><span>${{ number_format($total, 2) }}</span></div>
            <div class="summary-row"><span>Shipping</span><span>Free</span></div>
            <div class="summary-total"><span>Total</span><span>${{ number_format($total, 2) }}</span></div>
            <button class="btn btn-gold" style="width:100%;margin-top:20px;justify-content:center" onclick="window.location='/checkout'">
                <i class="fas fa-credit-card"></i> Checkout
            </button>
        </div>
    </div>

    @else
    <div class="empty-cart">
        <i class="fas fa-shopping-bag"></i>
        <h3>Your cart is empty</h3>
        <p>Looks like you haven't added anything yet.</p>
        <a href="/product" class="btn btn-gold btn-lg"><i class="fas fa-arrow-right"></i> Shop Now</a>
    </div>
    @endif
</div>
@endsection

