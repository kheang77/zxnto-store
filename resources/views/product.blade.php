@extends('master')
@section('title', 'Shop â€” ZXNTO')

@section('head')
<style>
    .shop-header {
        padding: 80px 32px 48px;
        border-bottom: 1px solid var(--border);
        background: var(--bg2);
    }
    .shop-header-inner { max-width: 1320px; margin: 0 auto; }
    .shop-header h1 {
        font-family: var(--font-head); font-size: 3rem; font-weight: 800;
        text-transform: uppercase; letter-spacing: -.01em; margin-bottom: 6px;
    }
    .shop-header p { color: var(--muted); font-size: .9rem; }

    .shop-bar {
        position: sticky; top: 64px; z-index: 200;
        background: rgba(14,14,15,.92); backdrop-filter: blur(16px);
        border-bottom: 1px solid var(--border); padding: 14px 32px;
    }
    .shop-bar-inner {
        max-width: 1320px; margin: 0 auto;
        display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
    }
    .s-input-wrap { position: relative; flex: 1; min-width: 180px; max-width: 300px; }
    .s-input-wrap i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: .8rem; }
    .s-input {
        width: 100%; padding: 9px 12px 9px 34px;
        background: var(--surface); border: 1px solid var(--border2);
        border-radius: var(--radius); color: var(--text); font-family: var(--font-body);
        font-size: .82rem; outline: none; transition: border .2s;
    }
    .s-input::placeholder { color: var(--muted); }
    .s-input:focus { border-color: var(--gold); }
    .s-select {
        padding: 9px 14px; background: var(--surface); border: 1px solid var(--border2);
        border-radius: var(--radius); color: var(--text); font-family: var(--font-body);
        font-size: .82rem; outline: none; cursor: pointer; transition: border .2s;
    }
    .s-select:focus { border-color: var(--gold); }
    .bar-right { margin-left: auto; display: flex; align-items: center; gap: 10px; }
    .results-label { font-size: .78rem; color: var(--muted); white-space: nowrap; }

    .shop-body { max-width: 1320px; margin: 48px auto; padding: 0 32px 80px; }

    .products-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 1px; background: var(--border); }
    .pcard {
        background: var(--bg); display: flex; flex-direction: column;
        transition: background .2s; cursor: pointer; position: relative; overflow: hidden;
    }
    .pcard:hover { background: var(--bg2); }
    .pcard-img { aspect-ratio: 1; overflow: hidden; background: var(--bg2); position: relative; }
    .pcard-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; filter: grayscale(15%); }
    .pcard:hover .pcard-img img { transform: scale(1.07); filter: grayscale(0%); }
    .stock-badge {
        position: absolute; top: 12px; right: 12px; z-index: 2;
        font-size: .65rem; font-weight: 700; padding: 4px 10px; border-radius: 100px;
        text-transform: uppercase; letter-spacing: .06em;
    }
    .s-ok  { background: rgba(62,207,142,.15); color: var(--green); border: 1px solid rgba(62,207,142,.3); }
    .s-low { background: rgba(249,115,22,.15);  color: #f97316;      border: 1px solid rgba(249,115,22,.3); }
    .s-out { background: rgba(224,82,82,.15);   color: var(--red);   border: 1px solid rgba(224,82,82,.3); }
    .pcard-body { padding: 20px 20px 24px; flex: 1; display: flex; flex-direction: column; }
    .pcard-cat { font-size: .68rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .12em; margin-bottom: 6px; }
    .pcard-name { font-family: var(--font-head); font-size: 1rem; font-weight: 700; color: var(--text); margin-bottom: 8px; line-height: 1.2; }
    .pcard-desc { font-size: .8rem; color: var(--muted); flex: 1; margin-bottom: 18px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .pcard-foot { display: flex; align-items: center; justify-content: space-between; gap: 8px; }
    .pcard-price { font-family: var(--font-head); font-size: 1.1rem; font-weight: 700; color: var(--gold); }
    .pcard-actions { display: flex; gap: 6px; }
    .pcard-btn {
        width: 34px; height: 34px; border-radius: var(--radius);
        background: var(--surface); border: 1px solid var(--border2);
        color: var(--muted); display: flex; align-items: center; justify-content: center;
        font-size: .8rem; cursor: pointer; transition: all .2s;
    }
    .pcard-btn:hover { background: var(--gold); color: #0e0e0f; border-color: var(--gold); }
    .pcard-btn.primary { background: var(--gold); color: #0e0e0f; border-color: var(--gold); }
    .pcard-btn.primary:hover { background: var(--gold2); }

    .empty-state { grid-column: 1/-1; text-align: center; padding: 100px 20px; }
    .empty-state i { font-size: 3rem; color: var(--border2); margin-bottom: 16px; display: block; }
    .empty-state h3 { font-family: var(--font-head); font-size: 1.4rem; font-weight: 700; margin-bottom: 8px; }
    .empty-state p { color: var(--muted); margin-bottom: 24px; }

    .pagination-wrap { display: flex; justify-content: center; margin-top: 56px; gap: 6px; }
    .pagination-wrap a, .pagination-wrap span {
        display: flex; align-items: center; justify-content: center;
        width: 38px; height: 38px; border-radius: var(--radius);
        border: 1px solid var(--border2); font-size: .82rem; font-weight: 600;
        color: var(--muted); transition: all .2s; background: var(--surface);
    }
    .pagination-wrap a:hover { border-color: var(--gold); color: var(--gold); }
    .pagination-wrap .active { background: var(--gold); color: #0e0e0f; border-color: var(--gold); }

    /* Modal */
    .modal-overlay {
        display: none; position: fixed; inset: 0; z-index: 500;
        background: rgba(0,0,0,.8); backdrop-filter: blur(8px);
        align-items: center; justify-content: center; padding: 20px;
    }
    .modal-overlay.open { display: flex; }
    .modal-box {
        background: var(--bg2); border: 1px solid var(--border2);
        border-radius: var(--radius-lg); max-width: 720px; width: 100%;
        overflow: hidden; box-shadow: var(--shadow-lg);
        display: grid; grid-template-columns: 1fr 1fr; position: relative;
    }
    .modal-img { overflow: hidden; background: var(--bg3); }
    .modal-img img { width: 100%; height: 100%; object-fit: cover; }
    .modal-body { padding: 36px; display: flex; flex-direction: column; }
    .modal-cat { font-size: .68rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .12em; margin-bottom: 8px; }
    .modal-name { font-family: var(--font-head); font-size: 1.5rem; font-weight: 800; margin-bottom: 10px; line-height: 1.1; }
    .modal-price { font-family: var(--font-head); font-size: 2rem; font-weight: 800; color: var(--gold); margin-bottom: 16px; }
    .modal-desc { font-size: .875rem; color: var(--muted); flex: 1; line-height: 1.8; margin-bottom: 20px; }
    .modal-stock { font-size: .8rem; color: var(--muted); margin-bottom: 24px; }
    .modal-close {
        position: absolute; top: 14px; right: 14px;
        width: 32px; height: 32px; border-radius: var(--radius);
        background: var(--surface); border: 1px solid var(--border2);
        color: var(--muted); cursor: pointer; display: flex; align-items: center; justify-content: center;
        font-size: .8rem; transition: all .2s;
    }
    .modal-close:hover { background: var(--red); color: #fff; border-color: var(--red); }

    @media (max-width: 1100px) { .products-grid { grid-template-columns: repeat(3,1fr); } }
    @media (max-width: 768px)  { .products-grid { grid-template-columns: repeat(2,1fr); } .modal-box { grid-template-columns: 1fr; } .modal-img { display: none; } }
    @media (max-width: 480px)  { .products-grid { grid-template-columns: 1fr; } .shop-bar-inner { gap: 8px; } }

    /* ── ADD MODAL ── */
    .add-modal-overlay { display:none; position:fixed; inset:0; z-index:600; background:rgba(0,0,0,.75); backdrop-filter:blur(6px); align-items:center; justify-content:center; padding:20px; }
    .add-modal-overlay.open { display:flex; }
    .add-modal-box { background:var(--bg2); border:1px solid var(--border2); border-radius:var(--radius-lg); max-width:540px; width:100%; display:grid; grid-template-columns:190px 1fr; overflow:hidden; position:relative; box-shadow:var(--shadow-lg); }
    .add-modal-close { position:absolute; top:12px; right:12px; z-index:2; width:30px; height:30px; border-radius:var(--radius); background:var(--surface); border:1px solid var(--border2); color:var(--muted); cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:.75rem; transition:all .2s; }
    .add-modal-close:hover { background:var(--red); color:#fff; border-color:var(--red); }
    .add-modal-img { overflow:hidden; background:var(--bg3); }
    .add-modal-img img { width:100%; height:100%; object-fit:cover; }
    .add-modal-body { padding:24px 20px; display:flex; flex-direction:column; }
    .add-modal-name { font-family:var(--font-head); font-size:1rem; font-weight:800; text-transform:uppercase; margin-bottom:4px; }
    .add-modal-price { font-family:var(--font-head); font-size:1.3rem; font-weight:800; color:var(--gold); margin-bottom:18px; }
    .add-modal-section { margin-bottom:16px; }
    .add-modal-label { font-size:.68rem; font-weight:700; color:var(--muted); text-transform:uppercase; letter-spacing:.12em; margin-bottom:8px; }
    .size-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:5px; }
    .size-btn { padding:8px 4px; border-radius:var(--radius); font-size:.8rem; font-weight:700; background:var(--bg3); border:1px solid var(--border2); color:var(--muted); cursor:pointer; transition:all .2s; text-align:center; }
    .size-btn:hover { border-color:var(--gold); color:var(--gold); }
    .size-btn.active { background:var(--gold); color:#0e0e0f; border-color:var(--gold); }
    .qty-row { display:flex; align-items:center; gap:8px; }
    .qty-ctrl { width:30px; height:30px; border-radius:var(--radius); background:var(--surface); border:1px solid var(--border2); color:var(--text); cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:.75rem; transition:all .2s; }
    .qty-ctrl:hover { background:var(--gold); color:#0e0e0f; border-color:var(--gold); }
    .qty-val { width:48px; text-align:center; background:var(--bg3); border:1px solid var(--border2); border-radius:var(--radius); color:var(--text); font-family:var(--font-body); font-size:.875rem; padding:5px; outline:none; }
    @media(max-width:480px){ .add-modal-box{grid-template-columns:1fr} .add-modal-img{height:160px} }
</style>
@endsection

@section('content')

<div class="shop-header">
    <div class="shop-header-inner">
        <h1>Shop All Shoes</h1>
        <p>{{ $product->total() }} products available</p>
    </div>
</div>

<div class="shop-bar">
    <form method="GET" action="/product" class="shop-bar-inner" id="filterForm">
        <div class="s-input-wrap">
            <i class="fas fa-search"></i>
            <input type="text" class="s-input" name="search" placeholder="Search shoes..." value="{{ request('search') }}">
        </div>
        <select name="category" class="s-select" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <select name="sort" class="s-select" onchange="this.form.submit()">
            <option value="id"    {{ request('sort','id') == 'id'    ? 'selected' : '' }}>Latest</option>
            <option value="name"  {{ request('sort') == 'name'  ? 'selected' : '' }}>Name Aâ€“Z</option>
            <option value="price" {{ request('sort') == 'price' ? 'selected' : '' }}>Price</option>
        </select>
        @if(request()->hasAny(['search','category','sort']))
            <a href="/product" class="btn btn-ghost btn-sm">Clear</a>
        @endif
        <div class="bar-right">
            <span class="results-label">{{ $product->total() }} results</span>
        </div>
    </form>
</div>

<div class="shop-body">
    <div class="products-grid">
        @forelse($product as $pro)
        <div class="pcard">
            <div class="pcard-img">
                <img src="{{ asset('storage/' . ($pro->img ?? 'photos/default.jpg')) }}"
                     alt="{{ $pro->name }}"
                     onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=500&q=80'">
                @if($pro->qty > 10)
                    <span class="stock-badge s-ok">In Stock</span>
                @elseif($pro->qty > 0)
                    <span class="stock-badge s-low">Low Stock</span>
                @else
                    <span class="stock-badge s-out">Sold Out</span>
                @endif
            </div>
            <div class="pcard-body">
                <div class="pcard-cat">{{ $pro->category->name ?? 'Uncategorized' }}</div>
                <div class="pcard-name">{{ Str::limit($pro->name, 40) }}</div>
                <div class="pcard-desc">{{ $pro->description }}</div>
                <div class="pcard-foot">
                    <span class="pcard-price">${{ number_format($pro->price, 2) }}</span>
                    <div class="pcard-actions">
                        <button class="pcard-btn" title="Quick view"
                            onclick="openModal('{{ addslashes($pro->name) }}','{{ $pro->category->name ?? '' }}','{{ number_format($pro->price,2) }}','{{ addslashes($pro->description) }}','{{ asset('storage/'.($pro->img??'')) }}','{{ $pro->qty }}','{{ $pro->id }}')">
                            <i class="fas fa-eye"></i>
                        </button>
                        @if(session('user'))
                            <button class="pcard-btn primary" title="Add to cart"
                                onclick="openAddModal('{{ $pro->id }}','{{ addslashes($pro->name) }}','{{ $pro->price }}','{{ asset('storage/'.($pro->img??'')) }}')">
                                <i class="fas fa-shopping-bag"></i>
                            </button>
                        @else
                            <a href="/user/login" class="pcard-btn" title="Login to add to cart" style="text-decoration:none"><i class="fas fa-lock"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="fas fa-box-open"></i>
            <h3>No products found</h3>
            <p>Try adjusting your search or filter criteria.</p>
            <a href="/product" class="btn btn-gold">Clear Filters</a>
        </div>
        @endforelse
    </div>

    @if($product->hasPages())
    <div class="pagination-wrap">{{ $product->links() }}</div>
    @endif
</div>

<div class="modal-overlay" id="quickModal" onclick="if(event.target===this)closeModal()">
    <div class="modal-box">
        <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
        <div class="modal-img"><img id="mImg" src="" alt=""></div>
        <div class="modal-body">
            <div class="modal-cat" id="mCat"></div>
            <div class="modal-name" id="mName"></div>
            <div class="modal-price" id="mPrice"></div>
            <div class="modal-desc" id="mDesc"></div>
            <div class="modal-stock">Stock: <span id="mQty"></span> units</div>
            @if(session('user'))
                <button class="btn btn-gold" style="width:100%" onclick="closeModal();openAddModal(currentId,currentName,currentPrice,currentImg)">
                    <i class="fas fa-shopping-bag"></i> Add to Cart
                </button>
            @else
                <a href="/user/login" class="btn btn-ghost" style="width:100%;justify-content:center"><i class="fas fa-lock"></i> Login to Add to Cart</a>
            @endif
        </div>
    </div>
</div>

{{-- ADD TO CART MODAL --}}
@if(session('user'))
<div class="add-modal-overlay" id="addModal">
    <div class="add-modal-box">
        <button class="add-modal-close" onclick="closeAddModal()"><i class="fas fa-times"></i></button>
        <div class="add-modal-img"><img id="am-pimg" src="" alt=""></div>
        <div class="add-modal-body">
            <div class="add-modal-name" id="am-pname"></div>
            <div class="add-modal-price" id="am-pprice"></div>
            <form method="POST" action="/cart/add" id="addCartForm">
                @csrf
                <input type="hidden" name="id"    id="am-id">
                <input type="hidden" name="name"  id="am-name">
                <input type="hidden" name="price" id="am-price">
                <input type="hidden" name="img"   id="am-img">
                <input type="hidden" name="size"  id="am-size">
                <div class="add-modal-section">
                    <div class="add-modal-label">Select Size <span style="color:var(--red)">*</span></div>
                    <div class="size-grid">
                        @foreach(['38','39','40','41','42','43','44','45'] as $s)
                        <button type="button" class="size-btn" onclick="selectSize(this,'{{ $s }}')">{{ $s }}</button>
                        @endforeach
                    </div>
                    <div id="size-error" style="display:none;color:var(--red);font-size:.78rem;margin-top:6px">Please select a size.</div>
                </div>
                <div class="add-modal-section">
                    <div class="add-modal-label">Quantity</div>
                    <div class="qty-row">
                        <button type="button" class="qty-ctrl" onclick="changeQty(-1)"><i class="fas fa-minus"></i></button>
                        <input type="number" name="qty" id="am-qty" value="1" min="1" class="qty-val">
                        <button type="button" class="qty-ctrl" onclick="changeQty(1)"><i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center;margin-top:8px">
                    <i class="fas fa-shopping-bag"></i> Add to Cart
                </button>
            </form>
        </div>
    </div>
</div>
@endif

@section('scripts')
<script>
let currentId='', currentName='', currentPrice='', currentImg='';

function openModal(name, cat, price, desc, img, qty, id) {
    currentId=id||''; currentName=name; currentPrice=price; currentImg=img;
    document.getElementById('mName').textContent  = name;
    document.getElementById('mCat').textContent   = cat;
    document.getElementById('mPrice').textContent = '$' + price;
    document.getElementById('mDesc').textContent  = desc;
    document.getElementById('mImg').src           = img || 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=500&q=80';
    document.getElementById('mQty').textContent   = qty;
    document.getElementById('quickModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeModal() {
    document.getElementById('quickModal').classList.remove('open');
    document.body.style.overflow = '';
}
function openAddModal(id, name, price, img) {
    document.getElementById('am-id').value    = id;
    document.getElementById('am-name').value  = name;
    document.getElementById('am-price').value = price;
    document.getElementById('am-img').value   = img;
    document.getElementById('am-pname').textContent  = name;
    document.getElementById('am-pprice').textContent = '$' + parseFloat(price).toFixed(2);
    document.getElementById('am-pimg').src = img;
    document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('am-size').value = '';
    document.getElementById('am-qty').value  = 1;
    document.getElementById('size-error').style.display = 'none';
    document.getElementById('addModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}
function closeAddModal() {
    document.getElementById('addModal').classList.remove('open');
    document.body.style.overflow = '';
}
function selectSize(btn, size) {
    document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('am-size').value = size;
    document.getElementById('size-error').style.display = 'none';
}
function changeQty(delta) {
    const input = document.getElementById('am-qty');
    input.value = Math.max(1, parseInt(input.value) + delta);
}
document.getElementById('addModal')?.addEventListener('click', function(e) { if(e.target===this) closeAddModal(); });
document.addEventListener('keydown', e => { if(e.key==='Escape'){ closeModal(); closeAddModal(); } });
document.getElementById('addCartForm')?.addEventListener('submit', function(e) {
    if (!document.getElementById('am-size').value) {
        e.preventDefault();
        document.getElementById('size-error').style.display = 'block';
    }
});
</script>
@endsection

