<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ZXNTO â€” Premium Footwear')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:       #0e0e0f;
            --bg2:      #161618;
            --bg3:      #1e1e21;
            --surface:  #242428;
            --border:   #2e2e33;
            --border2:  #3a3a40;
            --text:     #f0eff0;
            --muted:    #8a8a95;
            --gold:     #c9a84c;
            --gold2:    #e8c96a;
            --red:      #e05252;
            --green:    #3ecf8e;
            --radius:   6px;
            --radius-lg: 12px;
            --shadow:   0 4px 32px rgba(0,0,0,.4);
            --shadow-lg: 0 16px 64px rgba(0,0,0,.6);
            --font-head: 'Syne', sans-serif;
            --font-body: 'Inter', sans-serif;
        }

        html { scroll-behavior: smooth; }
        body { font-family: var(--font-body); background: var(--bg); color: var(--text); line-height: 1.6; min-height: 100vh; }
        a { text-decoration: none; color: inherit; }
        img { display: block; }

        /* â”€â”€ SCROLLBAR â”€â”€ */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--border2); border-radius: 3px; }

        /* â”€â”€ NAV â”€â”€ */
        .nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 300;
            height: 64px;
            background: rgba(14,14,15,.85);
            backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--border);
        }
        .nav-inner {
            max-width: 1320px; margin: 0 auto; padding: 0 32px;
            height: 100%; display: flex; align-items: center; justify-content: space-between;
        }
        .nav-brand {
            font-family: var(--font-head); font-size: 1.5rem; font-weight: 800;
            letter-spacing: .08em; text-transform: uppercase;
            display: flex; align-items: center; gap: 10px;
        }
        .nav-brand .dot { color: var(--gold); }
        .nav-links { display: flex; align-items: center; gap: 2px; }
        .nav-links a {
            padding: 7px 16px; border-radius: var(--radius); font-size: .82rem;
            font-weight: 500; color: var(--muted); letter-spacing: .04em;
            text-transform: uppercase; transition: all .2s;
        }
        .nav-links a:hover { color: var(--text); }
        .nav-links a.active { color: var(--gold); }
        .nav-right { display: flex; align-items: center; gap: 8px; }

        /* â”€â”€ BUTTONS â”€â”€ */
        .btn {
            display: inline-flex; align-items: center; gap: 7px;
            padding: 10px 22px; border-radius: var(--radius);
            font-family: var(--font-body); font-size: .82rem; font-weight: 600;
            letter-spacing: .04em; text-transform: uppercase;
            cursor: pointer; border: none; transition: all .22s;
        }
        .btn-gold { background: var(--gold); color: #0e0e0f; }
        .btn-gold:hover { background: var(--gold2); transform: translateY(-1px); box-shadow: 0 6px 24px rgba(201,168,76,.3); }
        .btn-ghost { background: transparent; color: var(--muted); border: 1px solid var(--border2); }
        .btn-ghost:hover { color: var(--text); border-color: var(--muted); }
        .btn-outline-gold { background: transparent; color: var(--gold); border: 1px solid var(--gold); }
        .btn-outline-gold:hover { background: var(--gold); color: #0e0e0f; }
        .btn-surface { background: var(--surface); color: var(--text); border: 1px solid var(--border2); }
        .btn-surface:hover { background: var(--bg3); border-color: var(--border2); }
        .btn-sm { padding: 7px 16px; font-size: .78rem; }
        .btn-lg { padding: 14px 32px; font-size: .9rem; }
        .hamburger { display: none; background: none; border: none; cursor: pointer; color: var(--text); padding: 6px; }

        /* â”€â”€ USER BADGE â”€â”€ */
        .nav-cart-btn {
            position: relative; display: flex; align-items: center; justify-content: center;
            width: 36px; height: 36px; border-radius: var(--radius);
            background: var(--surface); border: 1px solid var(--border2);
            color: var(--text); font-size: .9rem; transition: all .2s;
        }
        .nav-cart-btn:hover { border-color: var(--gold); color: var(--gold); }
        .cart-badge {
            position: absolute; top: -6px; right: -6px;
            background: var(--gold); color: #0e0e0f;
            font-size: .6rem; font-weight: 800; min-width: 18px; height: 18px;
            border-radius: 100px; display: flex; align-items: center; justify-content: center;
            padding: 0 4px;
        }
        .nav-user { display: flex; align-items: center; gap: 8px; }
        .nav-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            background: var(--gold); color: #0e0e0f;
            display: flex; align-items: center; justify-content: center;
            font-size: .75rem; font-weight: 700;
        }
        .nav-username { font-size: .82rem; font-weight: 600; color: var(--text); text-transform: capitalize; }

        /* â”€â”€ ALERTS â”€â”€ */
        .alert-wrap { max-width: 1320px; margin: 80px auto 0; padding: 16px 32px 0; }
        .alert {
            padding: 14px 18px; border-radius: var(--radius);
            display: flex; align-items: center; gap: 10px;
            font-size: .875rem; font-weight: 500; margin-bottom: 8px;
        }
        .alert-success { background: rgba(62,207,142,.1); color: var(--green); border: 1px solid rgba(62,207,142,.25); }
        .alert-error   { background: rgba(224,82,82,.1);  color: var(--red);   border: 1px solid rgba(224,82,82,.25); }

        /* â”€â”€ PAGE OFFSET â”€â”€ */
        .page-top { padding-top: 64px; }

        /* â”€â”€ FOOTER â”€â”€ */
        footer {
            background: var(--bg2); border-top: 1px solid var(--border);
            padding: 64px 32px 32px; margin-top: 0;
        }
        .footer-inner { max-width: 1320px; margin: 0 auto; }
        .footer-grid {
            display: grid; grid-template-columns: 2.5fr 1fr 1fr 1fr;
            gap: 48px; padding-bottom: 48px; border-bottom: 1px solid var(--border);
        }
        .footer-brand-name {
            font-family: var(--font-head); font-size: 1.4rem; font-weight: 800;
            letter-spacing: .08em; text-transform: uppercase; margin-bottom: 14px;
        }
        .footer-brand-name .dot { color: var(--gold); }
        .footer-desc { font-size: .85rem; color: var(--muted); line-height: 1.8; max-width: 260px; }
        .footer-col h5 {
            font-size: .72rem; font-weight: 700; color: var(--muted);
            text-transform: uppercase; letter-spacing: .1em; margin-bottom: 18px;
        }
        .footer-col a { display: block; font-size: .875rem; color: var(--muted); margin-bottom: 12px; transition: color .2s; }
        .footer-col a:hover { color: var(--gold); }
        .footer-socials { display: flex; gap: 10px; margin-top: 24px; }
        .footer-socials a {
            width: 36px; height: 36px; border-radius: var(--radius);
            background: var(--surface); border: 1px solid var(--border2);
            display: flex; align-items: center; justify-content: center;
            color: var(--muted); font-size: .8rem; transition: all .2s;
        }
        .footer-socials a:hover { background: var(--gold); color: #0e0e0f; border-color: var(--gold); }
        .footer-bottom {
            padding-top: 24px; display: flex; justify-content: space-between;
            align-items: center; font-size: .78rem; color: var(--muted);
        }

        /* â”€â”€ UTILS â”€â”€ */
        .wrap { max-width: 1320px; margin: 0 auto; padding: 0 32px; }
        .tag {
            display: inline-flex; align-items: center; gap: 5px;
            font-size: .7rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
            padding: 4px 12px; border-radius: 100px;
        }
        .tag-gold { background: rgba(201,168,76,.12); color: var(--gold); border: 1px solid rgba(201,168,76,.25); }
        .tag-red  { background: rgba(224,82,82,.12);  color: var(--red);  border: 1px solid rgba(224,82,82,.25); }
        .tag-green{ background: rgba(62,207,142,.12); color: var(--green);border: 1px solid rgba(62,207,142,.25); }

        /* â”€â”€ RESPONSIVE â”€â”€ */
        @media (max-width: 900px) {
            .nav-links { display: none; }
            .hamburger { display: flex; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }
        @media (max-width: 540px) {
            .footer-grid { grid-template-columns: 1fr; }
            .footer-bottom { flex-direction: column; gap: 8px; text-align: center; }
            .wrap { padding: 0 20px; }
        }

        /* â”€â”€ MOBILE NAV DRAWER â”€â”€ */
        .nav-drawer {
            display: none; position: fixed; top: 64px; left: 0; right: 0; z-index: 299;
            background: var(--bg2); border-bottom: 1px solid var(--border);
            padding: 20px 32px; flex-direction: column; gap: 4px;
        }
        .nav-drawer.open { display: flex; }
        .nav-drawer a {
            padding: 12px 0; font-size: .9rem; font-weight: 500;
            color: var(--muted); border-bottom: 1px solid var(--border);
            text-transform: uppercase; letter-spacing: .04em;
        }
        .nav-drawer a:last-child { border-bottom: none; }
        .nav-drawer a:hover, .nav-drawer a.active { color: var(--gold); }
    </style>
    @yield('head')
</head>
<body class="page-top">

<nav class="nav">
    <div class="nav-inner">
        <a href="/" class="nav-brand">ZXNTO<span class="dot">.</span></a>
        <div class="nav-links">
            <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="/product" class="{{ request()->is('product*') ? 'active' : '' }}">Shop</a>
            <a href="/about" class="{{ request()->is('about*') ? 'active' : '' }}">About</a>
        </div>
        <div class="nav-right">
            @if(session('user'))
                <a href="/cart" class="nav-cart-btn">
                    <i class="fas fa-shopping-bag"></i>
                    @php $cartCount = array_sum(array_column(session('cart', []), 'qty')); @endphp
                    @if($cartCount > 0)
                        <span class="cart-badge">{{ $cartCount }}</span>
                    @endif
                </a>
                @if(session('role') === 'admin')
                    <a href="/admin" class="btn btn-gold btn-sm"><i class="fas fa-shield-halved"></i> Admin</a>
                @endif
                <div class="nav-user">
                    <div class="nav-avatar"><i class="fas fa-user"></i></div>
                    <span class="nav-username">{{ explode('@', session('user'))[0] }}</span>
                </div>
                <a href="/user/logout" class="btn btn-ghost btn-sm"><i class="fas fa-right-from-bracket"></i> Logout</a>
            @else
                <a href="/user/login" class="btn btn-ghost btn-sm"><i class="fas fa-user"></i> Login</a>
            @endif
            <button class="hamburger" onclick="toggleDrawer()"><i class="fas fa-bars"></i></button>
        </div>
    </div>
</nav>

<div class="nav-drawer" id="navDrawer">
    <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
    <a href="/product" class="{{ request()->is('product*') ? 'active' : '' }}">Shop</a>
    <a href="/about" class="{{ request()->is('about*') ? 'active' : '' }}">About</a>
    @if(session('user'))
        <a href="/user/logout"><i class="fas fa-right-from-bracket"></i> Logout ({{ session('user') }})</a>
    @else
        <a href="/user/login"><i class="fas fa-user"></i> Login</a>
    @endif
</div>

@if(session('success'))
<div class="alert-wrap">
    <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
</div>
@endif
@if(session('error'))
<div class="alert-wrap">
    <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
</div>
@endif

@yield('content')

<footer>
    <div class="footer-inner">
        <div class="footer-grid">
            <div>
                <div class="footer-brand-name">ZXNTO<span class="dot">.</span></div>
                <p class="footer-desc">Cambodia's premier destination for authentic premium footwear. Over 10 years of bringing the world's best brands to your doorstep.</p>
                <div class="footer-socials">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-tiktok"></i></a>
                    <a href="#"><i class="fab fa-telegram"></i></a>
                </div>
            </div>
            <div class="footer-col">
                <h5>Shop</h5>
                <a href="/product">All Shoes</a>
                <a href="/product?category=1">Nike</a>
                <a href="/product?category=2">Adidas</a>
                <a href="/product?category=3">Puma</a>
                <a href="/product?category=4">New Balance</a>
            </div>
            <div class="footer-col">
                <h5>Company</h5>
                <a href="/about">About Us</a>
                <a href="#">Careers</a>
                <a href="#">Blog</a>
                <a href="#">Press</a>
            </div>
            <div class="footer-col">
                <h5>Support</h5>
                <a href="#">Size Guide</a>
                <a href="#">Returns</a>
                <a href="#">Shipping</a>
                <a href="#">Contact</a>
            </div>
        </div>
        <div class="footer-bottom">
            <span>Â© 2026 ZXNTO. All rights reserved.</span>
            <span>Phnom Penh, Cambodia Â· info@ZXNTO.com.kh</span>
        </div>
    </div>
</footer>

<script>
function toggleDrawer() {
    document.getElementById('navDrawer').classList.toggle('open');
}
</script>
@yield('scripts')
</body>
</html>

