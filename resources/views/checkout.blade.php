@extends('master')
@section('title', 'Checkout â€” ZXNTO')

@section('head')
<style>
    .checkout-wrap {
        max-width: 1100px; margin: 48px auto 100px; padding: 0 32px;
        display: grid; grid-template-columns: 1fr 400px; gap: 32px; align-items: start;
    }
    .co-title { font-family: var(--font-head); font-size: 2rem; font-weight: 800; text-transform: uppercase; letter-spacing: -.01em; margin-bottom: 28px; }

    /* Form card */
    .co-card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius-lg); overflow: hidden; margin-bottom: 20px; }
    .co-card-head { padding: 16px 24px; border-bottom: 1px solid var(--border); font-size: .7rem; font-weight: 700; color: var(--gold); text-transform: uppercase; letter-spacing: .14em; display: flex; align-items: center; gap: 8px; }
    .co-card-body { padding: 24px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
    .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 14px; }
    .form-group:last-child { margin-bottom: 0; }
    .form-label { font-size: .72rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .1em; }
    .form-label .req { color: var(--red); }
    .form-control { padding: 11px 14px; background: var(--bg3); border: 1px solid var(--border2); border-radius: var(--radius); color: var(--text); font-family: var(--font-body); font-size: .875rem; outline: none; transition: border .2s; width: 100%; }
    .form-control::placeholder { color: var(--muted); }
    .form-control:focus { border-color: var(--gold); }
    .form-control.error { border-color: var(--red); }
    textarea.form-control { resize: vertical; min-height: 80px; }
    .field-error { font-size: .75rem; color: var(--red); }

    /* Payment options */
    .payment-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
    .payment-option { position: relative; }
    .payment-option input { position: absolute; opacity: 0; width: 0; height: 0; }
    .payment-label {
        display: flex; align-items: center; gap: 12px;
        padding: 14px 16px; border: 1.5px solid var(--border2);
        border-radius: var(--radius); cursor: pointer; transition: all .2s;
        background: var(--bg3);
    }
    .payment-label:hover { border-color: var(--gold); }
    .payment-option input:checked + .payment-label { border-color: var(--gold); background: rgba(201,168,76,.08); }
    .payment-icon { font-size: 1.2rem; width: 28px; text-align: center; }
    .payment-name { font-size: .85rem; font-weight: 600; }
    .payment-sub { font-size: .72rem; color: var(--muted); }

    /* Order summary */
    .summary-card { background: var(--bg2); border: 1px solid var(--border); border-radius: var(--radius-lg); overflow: hidden; position: sticky; top: 80px; }
    .summary-head { padding: 16px 24px; border-bottom: 1px solid var(--border); font-size: .7rem; font-weight: 700; color: var(--gold); text-transform: uppercase; letter-spacing: .14em; }
    .summary-items { padding: 16px 24px; border-bottom: 1px solid var(--border); display: flex; flex-direction: column; gap: 14px; }
    .summary-item { display: flex; align-items: center; gap: 12px; }
    .summary-item-img { width: 52px; height: 52px; border-radius: var(--radius); overflow: hidden; background: var(--bg3); flex-shrink: 0; }
    .summary-item-img img { width: 100%; height: 100%; object-fit: cover; }
    .summary-item-name { font-size: .85rem; font-weight: 600; flex: 1; }
    .summary-item-meta { font-size: .75rem; color: var(--muted); margin-top: 2px; }
    .summary-item-price { font-family: var(--font-head); font-size: .9rem; font-weight: 700; color: var(--gold); white-space: nowrap; }
    .summary-totals { padding: 20px 24px; }
    .summary-row { display: flex; justify-content: space-between; font-size: .875rem; color: var(--muted); margin-bottom: 10px; }
    .summary-total-row { display: flex; justify-content: space-between; font-family: var(--font-head); font-size: 1.2rem; font-weight: 800; padding-top: 14px; border-top: 1px solid var(--border); margin-top: 4px; }
    .summary-total-row span:last-child { color: var(--gold); }
    .btn-checkout { width: 100%; padding: 14px; background: var(--gold); color: #0e0e0f; border: none; border-radius: var(--radius); font-family: var(--font-body); font-size: .9rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; cursor: pointer; transition: all .2s; margin-top: 16px; display: flex; align-items: center; justify-content: center; gap: 8px; }
    .btn-checkout:hover { background: var(--gold2); transform: translateY(-1px); box-shadow: 0 6px 24px rgba(201,168,76,.3); }

    @media (max-width: 900px) {
        .checkout-wrap { grid-template-columns: 1fr; }
        .summary-card { position: static; }
    }
    @media (max-width: 540px) {
        .form-row { grid-template-columns: 1fr; }
        .payment-grid { grid-template-columns: 1fr; }
        .checkout-wrap { padding: 0 20px; }
    }
</style>
@endsection

@section('content')
<form method="POST" action="/checkout">
@csrf
<div class="checkout-wrap">

    {{-- LEFT: Form --}}
    <div>
        <div class="co-title">Checkout</div>

        @if($errors->any())
        <div style="background:rgba(224,82,82,.1);border:1px solid rgba(224,82,82,.3);color:var(--red);padding:14px 18px;border-radius:var(--radius);margin-bottom:20px;font-size:.875rem">
            <i class="fas fa-exclamation-circle"></i>
            @foreach($errors->all() as $e) <div>{{ $e }}</div> @endforeach
        </div>
        @endif

        {{-- Contact Info --}}
        <div class="co-card">
            <div class="co-card-head"><i class="fas fa-user"></i> Contact Information</div>
            <div class="co-card-body">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Full Name <span class="req">*</span></label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'error' : '' }}"
                               placeholder="Chan Kimkheang" value="{{ old('name') }}" required>
                        @error('name')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number <span class="req">*</span></label>
                        <input type="text" name="phone" class="form-control {{ $errors->has('phone') ? 'error' : '' }}"
                               placeholder="012 345 678" value="{{ old('phone') }}" required>
                        @error('phone')<span class="field-error">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Email Address <span class="req">*</span></label>
                    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}"
                           placeholder="you@example.com" value="{{ old('email', session('user')) }}" required>
                    @error('email')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Delivery Address <span class="req">*</span></label>
                    <textarea name="address" class="form-control {{ $errors->has('address') ? 'error' : '' }}"
                              placeholder="Street, Sangkat, Khan, Phnom Penh" required>{{ old('address') }}</textarea>
                    @error('address')<span class="field-error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Order Note <span style="color:var(--muted)">(optional)</span></label>
                    <textarea name="note" class="form-control" placeholder="Any special instructions...">{{ old('note') }}</textarea>
                </div>
            </div>
        </div>

        {{-- Payment --}}
        <div class="co-card">
            <div class="co-card-head"><i class="fas fa-credit-card"></i> Payment Method</div>
            <div class="co-card-body">
                <div class="payment-grid">
                    <div class="payment-option">
                        <input type="radio" name="payment" id="pay-cash" value="cash" {{ old('payment','cash') == 'cash' ? 'checked' : '' }}>
                        <label class="payment-label" for="pay-cash">
                            <span class="payment-icon"><i class="fas fa-money-bill-wave"></i></span>
                            <div><div class="payment-name">Cash on Delivery</div><div class="payment-sub">Pay when you receive</div></div>
                        </label>
                    </div>
                    <div class="payment-option">
                        <input type="radio" name="payment" id="pay-aba" value="aba" {{ old('payment') == 'aba' ? 'checked' : '' }}>
                        <label class="payment-label" for="pay-aba">
                            <span class="payment-icon"><i class="fas fa-building-columns"></i></span>
                            <div><div class="payment-name">ABA Bank</div><div class="payment-sub">Transfer via ABA</div></div>
                        </label>
                    </div>
                    <div class="payment-option">
                        <input type="radio" name="payment" id="pay-wing" value="wing" {{ old('payment') == 'wing' ? 'checked' : '' }}>
                        <label class="payment-label" for="pay-wing">
                            <span class="payment-icon"><i class="fas fa-mobile-screen"></i></span>
                            <div><div class="payment-name">Wing Money</div><div class="payment-sub">Pay via Wing</div></div>
                        </label>
                    </div>
                    <div class="payment-option">
                        <input type="radio" name="payment" id="pay-acleda" value="acleda" {{ old('payment') == 'acleda' ? 'checked' : '' }}>
                        <label class="payment-label" for="pay-acleda">
                            <span class="payment-icon"><i class="fas fa-credit-card"></i></span>
                            <div><div class="payment-name">ACLEDA</div><div class="payment-sub">Transfer via ACLEDA</div></div>
                        </label>
                    </div>
                </div>
                @error('payment')<span class="field-error" style="margin-top:8px;display:block">{{ $message }}</span>@enderror

                {{-- QR CODE PANEL --}}
                <div id="qr-panel" style="display:none;margin-top:20px">
                    <div style="border:1px solid var(--border2);border-radius:var(--radius-lg);overflow:hidden">
                        <div style="padding:14px 18px;border-bottom:1px solid var(--border);font-size:.7rem;font-weight:700;color:var(--gold);text-transform:uppercase;letter-spacing:.12em;display:flex;align-items:center;gap:8px">
                            <i class="fas fa-qrcode"></i> Scan to Pay
                        </div>
                        <div style="padding:24px;text-align:center;background:var(--bg3)">

                            {{-- ABA --}}
                            <div id="qr-aba" class="qr-block" style="display:none">
                                <div style="font-family:var(--font-head);font-size:1rem;font-weight:800;margin-bottom:4px">ABA Bank</div>
                                <div style="font-size:.8rem;color:var(--muted);margin-bottom:16px">Scan with ABA Mobile app</div>
                                <div style="background:#fff;padding:16px;border-radius:var(--radius);display:inline-block;margin-bottom:16px">
                                    <img src="{{ asset('photo/qr-aba.jpg') }}"
                                         alt="ABA QR" style="width:180px;height:180px;display:block;object-fit:contain">
                                </div>
                                <div style="font-size:.82rem;color:var(--muted)">Account: <strong style="color:var(--text)">ZXNTO STORE</strong></div>
                                <div style="font-size:.82rem;color:var(--muted)">Account No: <strong style="color:var(--gold)">000 123 456</strong></div>
                            </div>

                            {{-- WING --}}
                            <div id="qr-wing" class="qr-block" style="display:none">
                                <div style="font-family:var(--font-head);font-size:1rem;font-weight:800;margin-bottom:4px">Wing Money</div>
                                <div style="font-size:.8rem;color:var(--muted);margin-bottom:16px">Scan with Wing app</div>
                                <div style="background:#fff;padding:16px;border-radius:var(--radius);display:inline-block;margin-bottom:16px">
                                    <img src="{{ asset('photo/qr-aba.jpg') }}"
                                         alt="Wing QR" style="width:180px;height:180px;display:block;object-fit:contain">
                                </div>
                                <div style="font-size:.82rem;color:var(--muted)">Wing No: <strong style="color:var(--gold)">012 345 678</strong></div>
                                <div style="font-size:.82rem;color:var(--muted)">Name: <strong style="color:var(--text)">ZXNTO STORE</strong></div>
                            </div>

                            {{-- ACLEDA --}}
                            <div id="qr-acleda" class="qr-block" style="display:none">
                                <div style="font-family:var(--font-head);font-size:1rem;font-weight:800;margin-bottom:4px">ACLEDA Bank</div>
                                <div style="font-size:.8rem;color:var(--muted);margin-bottom:16px">Scan with ACLEDA Unity app</div>
                                <div style="background:#fff;padding:16px;border-radius:var(--radius);display:inline-block;margin-bottom:16px">
                                    <img src="{{ asset('photo/qr-aba.jpg') }}"
                                         alt="ACLEDA QR" style="width:180px;height:180px;display:block;object-fit:contain">
                                </div>
                                <div style="font-size:.82rem;color:var(--muted)">Account: <strong style="color:var(--text)">ZXNTO STORE</strong></div>
                                <div style="font-size:.82rem;color:var(--muted)">Account No: <strong style="color:var(--gold)">1234 5678 9012</strong></div>
                            </div>

                            <div style="margin-top:16px;padding:12px 16px;background:rgba(201,168,76,.08);border:1px solid rgba(201,168,76,.2);border-radius:var(--radius);font-size:.8rem;color:var(--muted)">
                                <i class="fas fa-info-circle" style="color:var(--gold)"></i>
                                After payment, click <strong style="color:var(--text)">Place Order</strong> to confirm your order.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT: Order Summary --}}
    <div>
        <div class="summary-card">
            <div class="summary-head"><i class="fas fa-receipt"></i> Order Summary</div>
            <div class="summary-items">
                @foreach($cart as $item)
                <div class="summary-item">
                    <div class="summary-item-img">
                        <img src="{{ $item['img'] }}" alt="{{ $item['name'] }}"
                             onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=100&q=60'">
                    </div>
                    <div style="flex:1">
                        <div class="summary-item-name">{{ $item['name'] }}</div>
                        <div class="summary-item-meta">
                            Qty: {{ $item['qty'] }}
                            @if(!empty($item['size'])) Â· Size {{ $item['size'] }} @endif
                        </div>
                    </div>
                    <div class="summary-item-price">${{ number_format($item['price'] * $item['qty'], 2) }}</div>
                </div>
                @endforeach
            </div>
            <div class="summary-totals">
                <div class="summary-row"><span>Subtotal</span><span>${{ number_format($total, 2) }}</span></div>
                <div class="summary-row"><span>Shipping</span><span style="color:var(--green)">Free</span></div>
                <div class="summary-total-row"><span>Total</span><span>${{ number_format($total, 2) }}</span></div>
                <button type="submit" class="btn-checkout">
                    <i class="fas fa-lock"></i> Place Order
                </button>
                <a href="/cart" style="display:block;text-align:center;margin-top:12px;font-size:.8rem;color:var(--muted)">
                    <i class="fas fa-arrow-left"></i> Back to Cart
                </a>
            </div>
        </div>
    </div>

</div>
</form>
@endsection

@section('scripts')
<script>
function updateQR() {
    const selected = document.querySelector('input[name="payment"]:checked')?.value;
    const panel = document.getElementById('qr-panel');
    document.querySelectorAll('.qr-block').forEach(b => b.style.display = 'none');
    if (selected && selected !== 'cash') {
        panel.style.display = 'block';
        const block = document.getElementById('qr-' + selected);
        if (block) block.style.display = 'block';
    } else {
        panel.style.display = 'none';
    }
}
document.querySelectorAll('input[name="payment"]').forEach(r => r.addEventListener('change', updateQR));
updateQR();
</script>
@endsection


