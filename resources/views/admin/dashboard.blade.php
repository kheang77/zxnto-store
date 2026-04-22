@extends('admin.layout')
@section('title','Dashboard')
@section('page-title','Dashboard')

@section('content')

<div class="stat-grid">
    <div class="stat-card gold">
        <div class="stat-card-label"><i class="fas fa-shoe-prints"></i> Total Products</div>
        <div class="stat-card-num">{{ $totalProducts }}</div>
        <div class="stat-card-sub">In catalog</div>
    </div>
    <div class="stat-card">
        <div class="stat-card-label"><i class="fas fa-receipt"></i> Total Orders</div>
        <div class="stat-card-num" style="color:var(--green)">{{ $totalOrders }}</div>
        <div class="stat-card-sub"><span style="color:#f97316">{{ $pendingOrders }} pending</span></div>
    </div>
    <div class="stat-card yellow">
        <div class="stat-card-label"><i class="fas fa-triangle-exclamation"></i> Low Stock</div>
        <div class="stat-card-num" style="color:#f97316">{{ $lowStock }}</div>
        <div class="stat-card-sub">5 or fewer units</div>
    </div>
    <div class="stat-card red">
        <div class="stat-card-label"><i class="fas fa-ban"></i> Out of Stock</div>
        <div class="stat-card-num">{{ $outOfStock }}</div>
        <div class="stat-card-sub">Needs restocking</div>
    </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:20px">

    {{-- Recent Products --}}
    <div class="card">
        <div class="card-head">
            <div class="card-title">Recent Products</div>
            <a href="/admin/products/create" class="btn btn-gold btn-sm"><i class="fas fa-plus"></i> Add Product</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentProducts as $p)
                <tr>
                    <td>
                        <div class="td-img">
                            <img src="{{ asset('storage/'.($p->img??'')) }}"
                                 onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=100&q=60'" alt="">
                        </div>
                    </td>
                    <td style="font-weight:600">{{ Str::limit($p->name,30) }}</td>
                    <td><span class="badge badge-green">{{ $p->category->name ?? 'â€”' }}</span></td>
                    <td style="color:var(--gold);font-weight:700">${{ number_format($p->price,2) }}</td>
                    <td>
                        @if($p->qty > 10)
                            <span class="badge badge-green">{{ $p->qty }}</span>
                        @elseif($p->qty > 0)
                            <span class="badge badge-yellow">{{ $p->qty }}</span>
                        @else
                            <span class="badge badge-red">0</span>
                        @endif
                    </td>
                    <td>
                        <a href="/admin/products/{{ $p->id }}/edit" class="btn btn-ghost btn-sm btn-icon" title="Edit"><i class="fas fa-pen"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Categories --}}
    <div class="card">
        <div class="card-head">
            <div class="card-title">Categories</div>
            <a href="/admin/categories" class="btn btn-ghost btn-sm">Manage</a>
        </div>
        <table>
            <thead><tr><th>Name</th><th>Products</th></tr></thead>
            <tbody>
                @foreach($categories as $cat)
                <tr>
                    <td style="font-weight:600">{{ $cat->name }}</td>
                    <td><span class="badge badge-green">{{ $cat->products_count }}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection

