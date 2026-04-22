@extends('admin.layout')
@section('title','Orders')
@section('page-title','Orders')

@section('content')
<div class="card">
    <div class="card-head">
        <div class="card-title">All Orders <span style="color:var(--muted);font-size:.8rem;font-weight:400">({{ $orders->total() }})</span></div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Order #</th>
                <th>Customer</th>
                <th>Items</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td style="font-family:var(--font-head);font-size:.8rem;color:var(--gold)">{{ $order->order_number }}</td>
                <td>
                    <div style="font-weight:600;font-size:.875rem">{{ $order->customer_name }}</div>
                    <div style="font-size:.75rem;color:var(--muted)">{{ $order->customer_phone }}</div>
                </td>
                <td style="color:var(--muted);font-size:.82rem">{{ count($order->items) }} item(s)</td>
                <td style="font-family:var(--font-head);font-weight:700;color:var(--gold)">${{ number_format($order->total, 2) }}</td>
                <td><span class="badge badge-green">{{ ucfirst($order->payment_method) }}</span></td>
                <td>
                    @php
                        $statusClass = match($order->status) {
                            'pending'   => 'badge-yellow',
                            'confirmed' => 'badge-green',
                            'delivered' => 'badge-green',
                            'cancelled' => 'badge-red',
                            default     => 'badge-yellow',
                        };
                    @endphp
                    <span class="badge {{ $statusClass }}">{{ ucfirst($order->status) }}</span>
                </td>
                <td style="font-size:.78rem;color:var(--muted)">{{ $order->created_at->format('d M Y') }}</td>
                <td>
                    <button class="btn btn-ghost btn-sm" onclick="openOrder({{ $order->id }})">
                        <i class="fas fa-eye"></i>
                    </button>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--muted)">No orders yet.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($orders->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--border)">
        <div style="display:flex;align-items:center;justify-content:space-between;font-size:.8rem;color:var(--muted)">
            <span>Showing {{ $orders->firstItem() }}–{{ $orders->lastItem() }} of {{ $orders->total() }}</span>
            <div style="display:flex;gap:4px">
                @if($orders->onFirstPage())
                    <span style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border);color:var(--border2);background:var(--surface)"><i class="fas fa-chevron-left"></i></span>
                @else
                    <a href="{{ $orders->previousPageUrl() }}" style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border2);color:var(--muted);background:var(--surface)"><i class="fas fa-chevron-left"></i></a>
                @endif
                @foreach($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                    @if($page == $orders->currentPage())
                        <span style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);background:var(--gold);color:#0e0e0f;font-weight:700;font-size:.82rem">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border2);color:var(--muted);background:var(--surface);font-size:.82rem;font-weight:600">{{ $page }}</a>
                    @endif
                @endforeach
                @if($orders->hasMorePages())
                    <a href="{{ $orders->nextPageUrl() }}" style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border2);color:var(--muted);background:var(--surface)"><i class="fas fa-chevron-right"></i></a>
                @else
                    <span style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border);color:var(--border2);background:var(--surface)"><i class="fas fa-chevron-right"></i></span>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Order Detail Modal --}}
@foreach($orders as $order)
<div class="modal-overlay" id="order-{{ $order->id }}" onclick="if(event.target===this)this.classList.remove('open')">
    <div class="modal-box" style="max-width:600px">
        <button class="modal-close" onclick="document.getElementById('order-{{ $order->id }}').classList.remove('open')"><i class="fas fa-times"></i></button>
        <div class="modal-title">{{ $order->order_number }}</div>
        <div class="modal-sub">{{ $order->created_at->format('d M Y, H:i') }}</div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:16px;font-size:.85rem">
            <div><span style="color:var(--muted)">Name:</span> {{ $order->customer_name }}</div>
            <div><span style="color:var(--muted)">Phone:</span> {{ $order->customer_phone }}</div>
            <div style="grid-column:1/-1"><span style="color:var(--muted)">Email:</span> {{ $order->customer_email }}</div>
            <div style="grid-column:1/-1"><span style="color:var(--muted)">Address:</span> {{ $order->customer_address }}</div>
            @if($order->note)
            <div style="grid-column:1/-1"><span style="color:var(--muted)">Note:</span> {{ $order->note }}</div>
            @endif
        </div>

        <div style="border:1px solid var(--border);border-radius:var(--radius);overflow:hidden;margin-bottom:16px">
            @foreach($order->items as $item)
            <div style="display:flex;align-items:center;gap:12px;padding:12px 14px;border-bottom:1px solid var(--border)">
                <img src="{{ $item['img'] }}" style="width:40px;height:40px;object-fit:cover;border-radius:var(--radius)"
                     onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=80&q=60'">
                <div style="flex:1;font-size:.85rem">
                    <div style="font-weight:600">{{ $item['name'] }}</div>
                    <div style="color:var(--muted);font-size:.75rem">Qty: {{ $item['qty'] }}@if(!empty($item['size'])) Â· Size {{ $item['size'] }}@endif</div>
                </div>
                <div style="font-family:var(--font-head);font-weight:700;color:var(--gold)">${{ number_format($item['price']*$item['qty'],2) }}</div>
            </div>
            @endforeach
            <div style="padding:12px 14px;display:flex;justify-content:space-between;font-family:var(--font-head);font-weight:800">
                <span>Total</span><span style="color:var(--gold)">${{ number_format($order->total,2) }}</span>
            </div>
        </div>

        <form method="POST" action="/admin/orders/{{ $order->id }}/status" style="display:flex;gap:10px;align-items:center">
            @csrf
            <select name="status" class="s-select" style="flex:1">
                @foreach(['pending','confirmed','delivered','cancelled'] as $s)
                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-gold btn-sm">Update Status</button>
        </form>
    </div>
</div>
@endforeach

@endsection

@section('scripts')
<script>
function openOrder(id) {
    document.getElementById('order-' + id).classList.add('open');
}
</script>
@endsection

