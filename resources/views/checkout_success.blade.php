@extends('master')
@section('title', 'Order Confirmed — ZXNTO')

@section('head')
<style>
    .success-page { max-width: 720px; margin: 48px auto 100px; padding: 0 24px; }

    /* ── TOP STATUS ── */
    .success-status {
        text-align: center; padding: 40px 24px 32px;
        border-bottom: 1px solid var(--border); margin-bottom: 32px;
    }
    .success-icon {
        width: 72px; height: 72px; border-radius: 50%;
        background: rgba(62,207,142,.12); border: 2px solid rgba(62,207,142,.3);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.8rem; color: var(--green); margin: 0 auto 20px;
        animation: popIn .4s cubic-bezier(.175,.885,.32,1.275);
    }
    @keyframes popIn { from{transform:scale(0);opacity:0} to{transform:scale(1);opacity:1} }
    .success-title { font-family: var(--font-head); font-size: 2rem; font-weight: 800; text-transform: uppercase; margin-bottom: 6px; }
    .success-sub { color: var(--muted); font-size: .9rem; margin-bottom: 20px; }
    .order-badge {
        display: inline-flex; align-items: center; gap: 8px;
        background: rgba(201,168,76,.1); border: 1px solid rgba(201,168,76,.3);
        color: var(--gold); padding: 8px 20px; border-radius: 100px;
        font-family: var(--font-head); font-size: .85rem; font-weight: 700; letter-spacing: .1em;
    }

    /* ── RECEIPT ── */
    .receipt {
        background: var(--bg2); border: 1px solid var(--border);
        border-radius: var(--radius-lg); overflow: hidden; margin-bottom: 24px;
    }
    .receipt-header {
        background: var(--bg3); padding: 24px 28px;
        display: flex; align-items: center; justify-content: space-between;
        border-bottom: 1px solid var(--border);
    }
    .receipt-brand { font-family: var(--font-head); font-size: 1.4rem; font-weight: 800; letter-spacing: .08em; text-transform: uppercase; }
    .receipt-brand .dot { color: var(--gold); }
    .receipt-meta { text-align: right; font-size: .78rem; color: var(--muted); line-height: 1.8; }
    .receipt-meta strong { color: var(--text); }

    /* Dashed divider */
    .receipt-divider {
        border: none; border-top: 2px dashed var(--border);
        margin: 0;
    }

    /* Sections */
    .receipt-section { padding: 20px 28px; border-bottom: 1px solid var(--border); }
    .receipt-section:last-child { border-bottom: none; }
    .receipt-section-title {
        font-size: .65rem; font-weight: 700; color: var(--gold);
        text-transform: uppercase; letter-spacing: .16em; margin-bottom: 14px;
    }

    /* Info rows */
    .r-row { display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; padding: 6px 0; font-size: .85rem; }
    .r-label { color: var(--muted); flex-shrink: 0; }
    .r-val { font-weight: 600; text-align: right; }

    /* Items table */
    .items-table { width: 100%; border-collapse: collapse; }
    .items-table th { font-size: .65rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .1em; padding: 0 0 10px; text-align: left; border-bottom: 1px solid var(--border); }
    .items-table th:last-child { text-align: right; }
    .items-table td { padding: 12px 0; border-bottom: 1px solid var(--border); vertical-align: middle; font-size: .875rem; }
    .items-table tr:last-child td { border-bottom: none; }
    .item-img { width: 44px; height: 44px; border-radius: var(--radius); overflow: hidden; background: var(--bg3); flex-shrink: 0; }
    .item-img img { width: 100%; height: 100%; object-fit: cover; }
    .item-info { display: flex; align-items: center; gap: 12px; }
    .item-name { font-weight: 600; }
    .item-meta { font-size: .75rem; color: var(--muted); margin-top: 2px; }

    /* Totals */
    .totals-row { display: flex; justify-content: space-between; font-size: .875rem; color: var(--muted); padding: 6px 0; }
    .totals-final { display: flex; justify-content: space-between; padding: 14px 0 0; border-top: 1px solid var(--border); margin-top: 8px; }
    .totals-final .label { font-family: var(--font-head); font-size: 1rem; font-weight: 800; text-transform: uppercase; }
    .totals-final .amount { font-family: var(--font-head); font-size: 1.4rem; font-weight: 800; color: var(--gold); }

    /* Status badge */
    .status-badge {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 5px 14px; border-radius: 100px; font-size: .75rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: .06em;
    }
    .status-pending  { background: rgba(249,115,22,.1); color: #f97316; border: 1px solid rgba(249,115,22,.25); }
    .status-confirmed{ background: rgba(62,207,142,.1); color: var(--green); border: 1px solid rgba(62,207,142,.25); }

    /* Footer note */
    .receipt-footer {
        padding: 16px 28px; background: var(--bg3);
        font-size: .78rem; color: var(--muted); text-align: center; line-height: 1.7;
        border-top: 2px dashed var(--border);
    }

    /* Actions */
    .page-actions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; margin-top: 24px; }

    /* ── PRINT STYLES ── */
    @media print {
        body { background: #fff !important; color: #000 !important; }
        .nav, footer, .page-actions, .success-status { display: none !important; }
        .receipt { border: 1px solid #ddd !important; background: #fff !important; box-shadow: none !important; }
        .receipt-header { background: #f5f5f5 !important; }
        .receipt-brand, .receipt-section-title, .totals-final .amount { color: #c9a84c !important; }
        .r-label, .item-meta, .totals-row, .receipt-footer { color: #666 !important; }
        .success-page { margin: 0 !important; max-width: 100% !important; }
    }
</style>
@endsection

@section('content')
<div class="success-page">

    {{-- Status Header --}}
    <div class="success-status">
        <div class="success-icon"><i class="fas fa-check"></i></div>
        <div class="success-title">Order Confirmed!</div>
        <div class="success-sub">Thank you, <strong>{{ $order->customer_name }}</strong>. Your order has been placed successfully.</div>
        <div class="order-badge"><i class="fas fa-receipt"></i> {{ $order->order_number }}</div>
    </div>

    {{-- RECEIPT --}}
    <div class="receipt" id="receipt">

        {{-- Receipt Header --}}
        <div class="receipt-header">
            <div>
                <div class="receipt-brand">ZXNTO<span class="dot">.</span></div>
                <div style="font-size:.75rem;color:var(--muted);margin-top:4px">Phnom Penh, Cambodia</div>
            </div>
            <div class="receipt-meta">
                <div><strong>Receipt</strong></div>
                <div>{{ $order->order_number }}</div>
                <div>{{ $order->created_at->format('d M Y, H:i') }}</div>
                <div style="margin-top:6px">
                    <span class="status-badge status-{{ $order->status }}">
                        <i class="fas fa-circle" style="font-size:.5rem"></i>
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>

        <hr class="receipt-divider">

        {{-- Customer Info --}}
        <div class="receipt-section">
            <div class="receipt-section-title"><i class="fas fa-user"></i> Bill To</div>
            <div class="r-row"><span class="r-label">Name</span><span class="r-val">{{ $order->customer_name }}</span></div>
            <div class="r-row"><span class="r-label">Email</span><span class="r-val">{{ $order->customer_email }}</span></div>
            <div class="r-row"><span class="r-label">Phone</span><span class="r-val">{{ $order->customer_phone }}</span></div>
            <div class="r-row"><span class="r-label">Address</span><span class="r-val">{{ $order->customer_address }}</span></div>
            @if($order->note)
            <div class="r-row"><span class="r-label">Note</span><span class="r-val">{{ $order->note }}</span></div>
            @endif
        </div>

        {{-- Payment --}}
        <div class="receipt-section">
            <div class="receipt-section-title"><i class="fas fa-credit-card"></i> Payment</div>
            <div class="r-row">
                <span class="r-label">Method</span>
                <span class="r-val">
                    @php
                        $payIcons = ['cash'=>'fa-money-bill-wave','aba'=>'fa-building-columns','wing'=>'fa-mobile-screen','acleda'=>'fa-credit-card'];
                        $payNames = ['cash'=>'Cash on Delivery','aba'=>'ABA Bank','wing'=>'Wing Money','acleda'=>'ACLEDA Bank'];
                    @endphp
                    <i class="fas {{ $payIcons[$order->payment_method] ?? 'fa-credit-card' }}"></i>
                    {{ $payNames[$order->payment_method] ?? ucfirst($order->payment_method) }}
                </span>
            </div>
            <div class="r-row"><span class="r-label">Status</span><span class="r-val" style="color:var(--green)"><i class="fas fa-check-circle"></i> Received</span></div>
        </div>

        {{-- Items --}}
        <div class="receipt-section">
            <div class="receipt-section-title"><i class="fas fa-shoe-prints"></i> Items</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th style="text-align:center">Qty</th>
                        <th style="text-align:right">Unit Price</th>
                        <th style="text-align:right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>
                            <div class="item-info">
                                <div class="item-img">
                                    <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}"
                                         onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=100&q=60'">
                                </div>
                                <div>
                                    <div class="item-name">{{ $item['name'] }}</div>
                                    <div class="item-meta">
                                        @if(!empty($item['size'])) Size {{ $item['size'] }} @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td style="text-align:center;color:var(--muted)">{{ $item['qty'] }}</td>
                        <td style="text-align:right;color:var(--muted)">${{ number_format($item['price'], 2) }}</td>
                        <td style="text-align:right;font-weight:700;color:var(--gold)">${{ number_format($item['price'] * $item['qty'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="margin-top:16px">
                <div class="totals-row"><span>Subtotal</span><span>${{ number_format($order->total, 2) }}</span></div>
                <div class="totals-row"><span>Shipping</span><span style="color:var(--green)">Free</span></div>
                <div class="totals-final">
                    <span class="label">Total</span>
                    <span class="amount">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <hr class="receipt-divider">
        <div class="receipt-footer">
            Thank you for shopping with <strong>ZXNTO</strong>.<br>
            For support: info@zxnto.com.kh &nbsp;·&nbsp; 012 345 678<br>
            <span style="font-size:.7rem;opacity:.6">This is your official receipt. Please keep it for your records.</span>
        </div>

    </div>

    {{-- Actions --}}
    <div class="page-actions">
        <a href="/" class="btn btn-ghost"><i class="fas fa-home"></i> Back to Home</a>
        <button onclick="window.print()" class="btn btn-ghost"><i class="fas fa-print"></i> Print Receipt</button>
        <a href="/product" class="btn btn-gold"><i class="fas fa-shopping-bag"></i> Continue Shopping</a>
    </div>

</div>
@endsection
