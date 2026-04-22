@extends('master')
@section('title', 'ZXNTO â€” Premium Footwear')

@section('head')
<style>
    /* â”€â”€ HERO â”€â”€ */
    .hero {
        min-height: 100vh;
        display: grid; grid-template-columns: 1fr 1fr;
        position: relative; overflow: hidden;
    }
    .hero-left {
        display: flex; flex-direction: column; justify-content: center;
        padding: 120px 64px 80px 80px; position: relative; z-index: 2;
    }
    .hero-eyebrow { display: flex; align-items: center; gap: 12px; margin-bottom: 28px; }
    .hero-eyebrow-line { width: 40px; height: 1px; background: var(--gold); }
    .hero-eyebrow span { font-size: .72rem; font-weight: 700; letter-spacing: .2em; text-transform: uppercase; color: var(--gold); }
    .hero h1 {
        font-family: var(--font-head); font-size: clamp(3rem, 5.5vw, 5.5rem);
        font-weight: 800; line-height: .95; letter-spacing: -.02em;
        margin-bottom: 28px; text-transform: uppercase;
    }
    .hero h1 em { font-style: normal; color: var(--gold); display: block; }
    .hero-sub { font-size: 1rem; color: var(--muted); max-width: 400px; line-height: 1.7; margin-bottom: 40px; }
    .hero-cta { display: flex; gap: 12px; flex-wrap: wrap; margin-bottom: 64px; }
    .hero-stats { display: flex; gap: 40px; padding-top: 40px; border-top: 1px solid var(--border); }
    .hero-stat-num { font-family: var(--font-head); font-size: 2rem; font-weight: 800; color: var(--text); line-height: 1; }
    .hero-stat-label { font-size: .72rem; color: var(--muted); text-transform: uppercase; letter-spacing: .08em; margin-top: 4px; }
    .hero-right { position: relative; background: var(--bg2); border-left: 1px solid var(--border); }
    .hero-right img { width: 100%; height: 100%; object-fit: cover; opacity: .7; mix-blend-mode: luminosity; }
    .hero-right::after { content: ''; position: absolute; inset: 0; background: linear-gradient(135deg, rgba(14,14,15,.6) 0%, transparent 60%); }
    .hero-scroll {
        position: absolute; bottom: 40px; left: 50%; transform: translateX(-50%);
        display: flex; flex-direction: column; align-items: center; gap: 8px;
        font-size: .7rem; letter-spacing: .15em; text-transform: uppercase; color: var(--muted); z-index: 3;
    }
    .hero-scroll-line {
        width: 1px; height: 48px; background: linear-gradient(to bottom, var(--gold), transparent);
        animation: scrollLine 1.8s ease-in-out infinite;
    }
    @keyframes scrollLine { 0%,100%{opacity:1;transform:scaleY(1)} 50%{opacity:.4;transform:scaleY(.6)} }

    /* â”€â”€ TICKER â”€â”€ */
    .ticker { background: var(--gold); color: #0e0e0f; padding: 12px 0; overflow: hidden; white-space: nowrap; }
    .ticker-track { display: inline-flex; animation: ticker 25s linear infinite; }
    .ticker-item {
        display: inline-flex; align-items: center; gap: 16px;
        font-family: var(--font-head); font-size: .78rem; font-weight: 700;
        letter-spacing: .12em; text-transform: uppercase; padding: 0 32px;
    }
    .ticker-item::after { content: 'âœ¦'; opacity: .5; }
    @keyframes ticker { from{transform:translateX(0)} to{transform:translateX(-50%)} }

    /* â”€â”€ BRANDS â”€â”€ */
    .brands-section { padding: 56px 0; border-bottom: 1px solid var(--border); }
    .brands-inner { max-width: 1320px; margin: 0 auto; padding: 0 32px; display: flex; align-items: center; gap: 32px; flex-wrap: wrap; }
    .brands-label { font-size: .7rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .12em; white-space: nowrap; }
    .brands-divider { width: 1px; height: 24px; background: var(--border); }
    .brand-tabs { display: flex; gap: 6px; flex-wrap: wrap; flex: 1; }
    .brand-tab { padding: 8px 20px; border-radius: var(--radius); font-size: .78rem; font-weight: 600; letter-spacing: .06em; text-transform: uppercase; background: transparent; color: var(--muted); border: 1px solid var(--border); cursor: pointer; transition: all .2s; }
    .brand-tab:hover { color: var(--text); border-color: var(--border2); }
    .brand-tab.active { background: var(--gold); color: #0e0e0f; border-color: var(--gold); }

    /* â”€â”€ SECTION â”€â”€ */
    .sec { padding: 96px 0; }
    .sec-inner { max-width: 1320px; margin: 0 auto; padding: 0 32px; }
    .sec-head { display: flex; align-items: flex-end; justify-content: space-between; margin-bottom: 48px; padding-bottom: 24px; border-bottom: 1px solid var(--border); }
    .sec-title { font-family: var(--font-head); font-size: 2.4rem; font-weight: 800; text-transform: uppercase; letter-spacing: -.01em; }

    /* â”€â”€ PRODUCT GRID â”€â”€ */
    .grid-4 { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1px; background: var(--border); }
    .pcard { background: var(--bg); display: flex; flex-direction: column; transition: background .2s; cursor: pointer; position: relative; overflow: hidden; }
    .pcard:hover { background: var(--bg2); }
    .pcard-img { aspect-ratio: 1; overflow: hidden; background: var(--bg2); position: relative; }
    .pcard-img img { width: 100%; height: 100%; object-fit: cover; transition: transform .5s; filter: grayscale(20%); }
    .pcard:hover .pcard-img img { transform: scale(1.07); filter: grayscale(0%); }
    .pcard-badge { position: absolute; top: 14px; left: 14px; z-index: 2; }
    .pcard-body { padding: 20px 20px 24px; flex: 1; display: flex; flex-direction: column; }
    .pcard-brand { font-size: .68rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .12em; margin-bottom: 6px; }
    .pcard-name { font-family: var(--font-head); font-size: 1.05rem; font-weight: 700; color: var(--text); margin-bottom: 8px; line-height: 1.2; }
    .pcard-desc { font-size: .82rem; color: var(--muted); flex: 1; margin-bottom: 18px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .pcard-foot { display: flex; align-items: center; justify-content: space-between; }
    .pcard-price { font-family: var(--font-head); font-size: 1.15rem; font-weight: 700; color: var(--gold); }
    .pcard-btn { width: 36px; height: 36px; border-radius: var(--radius); background: var(--surface); border: 1px solid var(--border2); color: var(--muted); display: flex; align-items: center; justify-content: center; font-size: .85rem; cursor: pointer; transition: all .2s; }
    .pcard-btn:hover { background: var(--gold); color: #0e0e0f; border-color: var(--gold); }

    /* â”€â”€ FEATURES STRIP â”€â”€ */
    .features-strip { background: var(--bg2); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
    .features-grid { display: grid; grid-template-columns: repeat(4, 1fr); }
    .feat { padding: 40px 32px; border-right: 1px solid var(--border); display: flex; align-items: flex-start; gap: 18px; }
    .feat:last-child { border-right: none; }
    .feat-icon {
        width: 44px; height: 44px; border-radius: var(--radius);
        background: rgba(201,168,76,.1); border: 1px solid rgba(201,168,76,.2);
        display: flex; align-items: center; justify-content: center;
        color: var(--gold); font-size: 1rem; flex-shrink: 0;
    }
    .feat-title { font-size: .9rem; font-weight: 700; margin-bottom: 4px; }
    .feat-desc { font-size: .8rem; color: var(--muted); line-height: 1.6; }

    /* â”€â”€ EDITORIAL â”€â”€ */
    .editorial { position: relative; overflow: hidden; min-height: 480px; display: flex; align-items: center; }
    .editorial-bg {
        position: absolute; inset: 0;
        background: url('https://images.unsplash.com/photo-1556906781-9a412961a28c?auto=format&fit=crop&w=1400&q=80') center/cover no-repeat;
        filter: brightness(.3) saturate(.6);
    }
    .editorial-inner {
        position: relative; z-index: 1;
        max-width: 1320px; margin: 0 auto; padding: 80px 32px;
        display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center;
    }
    .editorial h2 {
        font-family: var(--font-head); font-size: clamp(2rem, 4vw, 3.5rem);
        font-weight: 800; text-transform: uppercase; line-height: 1; letter-spacing: -.01em; margin-bottom: 20px;
    }
    .editorial h2 span { color: var(--gold); }
    .editorial p { color: var(--muted); font-size: .95rem; line-height: 1.8; margin-bottom: 32px; }
    .sec-label { font-size: .7rem; font-weight: 700; color: var(--gold); text-transform: uppercase; letter-spacing: .15em; margin-bottom: 8px; }
    .editorial-right { display: flex; flex-direction: column; gap: 16px; }
    .editorial-stat {
        padding: 20px 24px; background: rgba(255,255,255,.04);
        border: 1px solid rgba(255,255,255,.08); border-radius: var(--radius);
        display: flex; align-items: center; gap: 20px;
    }
    .editorial-stat-num { font-family: var(--font-head); font-size: 2rem; font-weight: 800; color: var(--gold); min-width: 80px; }
    .editorial-stat-label { font-size: .85rem; color: var(--muted); }

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

    /* â”€â”€ RESPONSIVE â”€â”€ */
    @media (max-width: 1100px) {
        .grid-4 { grid-template-columns: repeat(3, 1fr); }
        .hero { grid-template-columns: 1fr; min-height: auto; }
        .hero-right { display: none; }
        .hero-left { padding: 100px 32px 60px; }
    }
    @media (max-width: 768px) {
        .grid-4 { grid-template-columns: repeat(2, 1fr); }
        .features-grid { grid-template-columns: 1fr 1fr; }
        .feat { border-bottom: 1px solid var(--border); }
        .editorial-inner { grid-template-columns: 1fr; gap: 40px; }
        .sec-head { flex-direction: column; align-items: flex-start; gap: 16px; }
    }
    @media (max-width: 480px) {
        .grid-4 { grid-template-columns: 1fr; }
        .features-grid { grid-template-columns: 1fr; }
        .hero-stats { gap: 24px; flex-wrap: wrap; }
    }
</style>
@endsection

@section('content')

{{-- HERO --}}
<section class="hero">
    <div class="hero-left">
        <div class="hero-eyebrow">
            <div class="hero-eyebrow-line"></div>
            <span>New Collection 2026</span>
        </div>
        <h1>
            Step Into
            <em>Premium</em>
            Comfort
        </h1>
        <p class="hero-sub">Cambodia's finest selection of authentic footwear â€” from everyday sneakers to performance shoes, curated for those who move with purpose.</p>
        <div class="hero-cta">
            <a href="/product" class="btn btn-gold btn-lg"><i class="fas fa-arrow-right"></i> Shop Collection</a>
            <a href="/about" class="btn btn-ghost btn-lg">Our Story</a>
        </div>
        <div class="hero-stats">
            <div>
                <div class="hero-stat-num">500+</div>
                <div class="hero-stat-label">Products</div>
            </div>
            <div>
                <div class="hero-stat-num">10K+</div>
                <div class="hero-stat-label">Customers</div>
            </div>
            <div>
                <div class="hero-stat-num">15+</div>
                <div class="hero-stat-label">Brands</div>
            </div>
        </div>
    </div>
    <div class="hero-right">
        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=900&q=80" alt="Featured Shoe">
        <div class="hero-scroll">
            <div class="hero-scroll-line"></div>
            <span>Scroll</span>
        </div>
    </div>
</section>

{{-- TICKER --}}
<div class="ticker" aria-hidden="true">
    <div class="ticker-track">
        @foreach(array_fill(0, 2, ['Nike','Adidas','Puma','New Balance','Converse','Vans','Reebok','Jordan','Asics','Skechers']) as $brands)
            @foreach($brands as $b)
            <span class="ticker-item">{{ $b }}</span>
            @endforeach
        @endforeach
    </div>
</div>

{{-- BRAND FILTER --}}
<div class="brands-section">
    <div class="brands-inner">
        <span class="brands-label">Filter by Brand</span>
        <div class="brands-divider"></div>
        <div class="brand-tabs">
            <button class="brand-tab active" data-cat="all">All</button>
            @foreach($categories as $cat)
            <button class="brand-tab" data-cat="{{ $cat->id }}">{{ $cat->name }}</button>
            @endforeach
        </div>
    </div>
</div>

{{-- PRODUCTS --}}
<section class="sec">
    <div class="sec-inner">
        <div class="sec-head">
            <div>
                <div class="sec-label">Featured</div>
                <div class="sec-title">Best Sellers</div>
            </div>
        </div>
        <div class="grid-4" id="productsGrid">
            @forelse($featured as $item)
            <div class="pcard" data-cat="{{ $item->cat_id }}">
                <div class="pcard-img">
                    <img src="{{ asset('storage/' . ($item->img ?? '')) }}"
                         alt="{{ $item->name }}" loading="lazy"
                         onerror="this.src='https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=500&q=80'">
                    @if($loop->first)
                    <div class="pcard-badge"><span class="tag tag-gold">Best Seller</span></div>
                    @elseif($loop->index === 2)
                    <div class="pcard-badge"><span class="tag tag-green">New</span></div>
                    @endif
                </div>
                <div class="pcard-body">
                    <div class="pcard-brand">{{ $item->category->name ?? 'Uncategorized' }}</div>
                    <div class="pcard-name">{{ $item->name }}</div>
                    <div class="pcard-desc">{{ $item->description }}</div>
                    <div class="pcard-foot">
                        <span class="pcard-price">${{ number_format($item->price, 2) }}</span>
                        @if(session('user'))
                            <button class="pcard-btn" title="Add to cart"
                                onclick="openAddModal('{{ $item->id }}','{{ addslashes($item->name) }}','{{ $item->price }}','{{ asset('storage/'.($item->img??'')) }}')">
                                <i class="fas fa-shopping-bag"></i>
                            </button>
                        @else
                            <a href="/user/login" class="pcard-btn" title="Login to add to cart" style="text-decoration:none"><i class="fas fa-lock"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:60px 20px;color:var(--muted)">
                <i class="fas fa-box-open" style="font-size:2.5rem;margin-bottom:12px;display:block"></i>
                No products yet. <a href="/admin/products/create" style="color:var(--gold)">Add some</a>.
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- FEATURES --}}
<div class="features-strip">
    <div class="features-grid">
        <div class="feat">
            <div class="feat-icon"><i class="fas fa-truck"></i></div>
            <div><div class="feat-title">Free Delivery</div><div class="feat-desc">Free shipping on orders over $50 within Phnom Penh.</div></div>
        </div>
        <div class="feat">
            <div class="feat-icon"><i class="fas fa-rotate-left"></i></div>
            <div><div class="feat-title">Easy Returns</div><div class="feat-desc">30-day hassle-free return policy on all products.</div></div>
        </div>
        <div class="feat">
            <div class="feat-icon"><i class="fas fa-shield-halved"></i></div>
            <div><div class="feat-title">100% Authentic</div><div class="feat-desc">Every product sourced directly from official distributors.</div></div>
        </div>
        <div class="feat">
            <div class="feat-icon"><i class="fas fa-headset"></i></div>
            <div><div class="feat-title">24/7 Support</div><div class="feat-desc">Always ready to help via Telegram or phone.</div></div>
        </div>
    </div>
</div>

{{-- EDITORIAL CTA --}}
<div class="editorial">
    <div class="editorial-bg"></div>
    <div class="editorial-inner">
        <div>
            <div class="sec-label" style="margin-bottom:16px">Our Promise</div>
            <h2>Built for <span>Those Who</span> Move</h2>
            <p>We don't just sell shoes. We curate experiences â€” every pair in our collection is hand-selected for quality, authenticity, and style that lasts beyond the season.</p>
            <a href="/product" class="btn btn-gold btn-lg"><i class="fas fa-arrow-right"></i> Shop the Collection</a>
        </div>
        <div class="editorial-right">
            <div class="editorial-stat">
                <div class="editorial-stat-num">10+</div>
                <div class="editorial-stat-label">Years serving Cambodia's footwear community</div>
            </div>
            <div class="editorial-stat">
                <div class="editorial-stat-num">500+</div>
                <div class="editorial-stat-label">Authentic styles from 15+ global brands</div>
            </div>
            <div class="editorial-stat">
                <div class="editorial-stat-num">10K+</div>
                <div class="editorial-stat-label">Happy customers across Cambodia</div>
            </div>
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

@endsection

@section('scripts')
<script>
document.querySelectorAll('.brand-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.brand-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        const cat = this.dataset.cat;
        document.querySelectorAll('.pcard').forEach(card => {
            card.style.display = (cat === 'all' || card.dataset.cat === cat) ? 'flex' : 'none';
        });
    });
});

function openAddModal(id, name, price, img) {
    document.getElementById('am-id').value    = id;
    document.getElementById('am-name').value  = name;
    document.getElementById('am-price').value = price;
    document.getElementById('am-img').value   = img;
    document.getElementById('am-pname').textContent  = name;
    document.getElementById('am-pprice').textContent = '$' + parseFloat(price).toFixed(2);
    document.getElementById('am-pimg').src = img || '';
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
document.getElementById('addModal')?.addEventListener('click', function(e) {
    if (e.target === this) closeAddModal();
});
document.addEventListener('keydown', e => { if(e.key === 'Escape') closeAddModal(); });
document.getElementById('addCartForm')?.addEventListener('submit', function(e) {
    if (!document.getElementById('am-size').value) {
        e.preventDefault();
        document.getElementById('size-error').style.display = 'block';
    }
});
</script>
@endsection

