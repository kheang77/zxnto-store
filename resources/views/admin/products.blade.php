@extends('admin.layout')
@section('title','Products')
@section('page-title','Products')

@section('content')

<div class="card">
    <div class="card-head">
        <div class="card-title">All Products <span style="color:var(--muted);font-size:.8rem;font-weight:400">({{ $products->total() }})</span></div>
        <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap">
            <form method="GET" action="/admin/products" class="search-bar">
                <div class="s-wrap">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" class="s-input" placeholder="Search products..." value="{{ request('search') }}">
                </div>
                <select name="category" class="s-select" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @if(request()->hasAny(['search','category']))
                    <a href="/admin/products" class="btn btn-ghost btn-sm">Clear</a>
                @endif
            </form>
            <a href="/admin/products/create" class="btn btn-gold btn-sm"><i class="fas fa-plus"></i> Add Product</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $p)
            <tr>
                <td style="color:var(--muted);font-size:.78rem">{{ $p->id }}</td>
                <td>
                    <div class="td-img">
                        <img src="{{ asset('storage/'.($p->img??'')) }}"
                             onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=100&q=60'" alt="">
                    </div>
                </td>
                <td style="font-weight:600;max-width:200px">{{ Str::limit($p->name,35) }}</td>
                <td><span class="badge badge-green">{{ $p->category->name ?? 'â€”' }}</span></td>
                <td style="color:var(--gold);font-weight:700">${{ number_format($p->price,2) }}</td>
                <td>
                    @if($p->qty > 10)
                        <span class="badge badge-green">{{ $p->qty }} in stock</span>
                    @elseif($p->qty > 0)
                        <span class="badge badge-yellow">Low ({{ $p->qty }})</span>
                    @else
                        <span class="badge badge-red">Out of stock</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex;gap:6px">
                        <a href="/admin/products/{{ $p->id }}/edit" class="btn btn-ghost btn-sm btn-icon" title="Edit"><i class="fas fa-pen"></i></a>
                        <button class="btn btn-red btn-sm btn-icon" title="Delete" onclick="confirmDelete('{{ $p->id }}','{{ addslashes($p->name) }}')"><i class="fas fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--muted)">No products found.</td></tr>
            @endforelse
        </tbody>
    </table>

    @if($products->hasPages())
    <div style="padding:16px 20px;border-top:1px solid var(--border)">
        <div style="display:flex;align-items:center;justify-content:space-between;font-size:.8rem;color:var(--muted)">
            <span>Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }}</span>
            <div style="display:flex;gap:4px">
                @if($products->onFirstPage())
                    <span style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border);color:var(--border2);background:var(--surface)"><i class="fas fa-chevron-left"></i></span>
                @else
                    <a href="{{ $products->previousPageUrl() }}" style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border2);color:var(--muted);background:var(--surface)"><i class="fas fa-chevron-left"></i></a>
                @endif
                @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    @if($page == $products->currentPage())
                        <span style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);background:var(--gold);color:#0e0e0f;font-weight:700;font-size:.82rem">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border2);color:var(--muted);background:var(--surface);font-size:.82rem;font-weight:600">{{ $page }}</a>
                    @endif
                @endforeach
                @if($products->hasMorePages())
                    <a href="{{ $products->nextPageUrl() }}" style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border2);color:var(--muted);background:var(--surface)"><i class="fas fa-chevron-right"></i></a>
                @else
                    <span style="display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border);color:var(--border2);background:var(--surface)"><i class="fas fa-chevron-right"></i></span>
                @endif
            </div>
        </div>
    </div>
    @endif
</div>

{{-- Delete Confirm Modal --}}
<div class="modal-overlay" id="deleteModal">
    <div class="modal-box">
        <button class="modal-close" onclick="closeDelete()"><i class="fas fa-times"></i></button>
        <div class="modal-title">Delete Product</div>
        <div class="modal-sub">Are you sure you want to delete <strong id="del-name"></strong>? This cannot be undone.</div>
        <form method="POST" id="deleteForm">
            @csrf
            <div style="display:flex;gap:10px;justify-content:flex-end">
                <button type="button" class="btn btn-ghost" onclick="closeDelete()">Cancel</button>
                <button type="submit" class="btn btn-red"><i class="fas fa-trash"></i> Delete</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
function confirmDelete(id, name) {
    document.getElementById('del-name').textContent = name;
    document.getElementById('deleteForm').action = '/admin/products/' + id + '/delete';
    document.getElementById('deleteModal').classList.add('open');
}
function closeDelete() {
    document.getElementById('deleteModal').classList.remove('open');
}
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDelete();
});
</script>
@endsection

