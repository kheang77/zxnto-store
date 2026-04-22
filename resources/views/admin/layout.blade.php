<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Admin') â€” ZXNTO</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
        :root{
            --bg:#0e0e0f;--bg2:#161618;--bg3:#1e1e21;--surface:#242428;
            --border:#2e2e33;--border2:#3a3a40;--text:#f0eff0;--muted:#8a8a95;
            --gold:#c9a84c;--gold2:#e8c96a;--red:#e05252;--green:#3ecf8e;
            --radius:6px;--radius-lg:12px;
            --font-head:'Syne',sans-serif;--font-body:'Inter',sans-serif;
        }
        body{font-family:var(--font-body);background:var(--bg);color:var(--text);display:flex;min-height:100vh}
        a{text-decoration:none;color:inherit}

        /* SIDEBAR */
        .sidebar{
            width:240px;flex-shrink:0;background:var(--bg2);
            border-right:1px solid var(--border);
            display:flex;flex-direction:column;
            position:fixed;top:0;left:0;bottom:0;z-index:100;
        }
        .sidebar-brand{
            padding:24px 20px;border-bottom:1px solid var(--border);
            font-family:var(--font-head);font-size:1.3rem;font-weight:800;
            letter-spacing:.08em;text-transform:uppercase;
        }
        .sidebar-brand .dot{color:var(--gold)}
        .sidebar-label{font-size:.62rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.14em;padding:20px 20px 8px}
        .sidebar-nav{flex:1;overflow-y:auto;padding-bottom:20px}
        .sidebar-link{
            display:flex;align-items:center;gap:12px;
            padding:11px 20px;font-size:.85rem;font-weight:500;color:var(--muted);
            transition:all .2s;border-left:2px solid transparent;
        }
        .sidebar-link:hover{color:var(--text);background:var(--bg3)}
        .sidebar-link.active{color:var(--gold);border-left-color:var(--gold);background:rgba(201,168,76,.06)}
        .sidebar-link i{width:16px;text-align:center;font-size:.85rem}
        .sidebar-footer{padding:16px 20px;border-top:1px solid var(--border)}
        .sidebar-user{display:flex;align-items:center;gap:10px;margin-bottom:12px}
        .sidebar-avatar{width:32px;height:32px;border-radius:50%;background:var(--gold);color:#0e0e0f;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:800}
        .sidebar-username{font-size:.85rem;font-weight:600}
        .sidebar-role{font-size:.72rem;color:var(--gold)}

        /* MAIN */
        .main{margin-left:240px;flex:1;display:flex;flex-direction:column;min-height:100vh}
        .topbar{
            height:60px;background:var(--bg2);border-bottom:1px solid var(--border);
            display:flex;align-items:center;justify-content:space-between;
            padding:0 28px;position:sticky;top:0;z-index:50;
        }
        .topbar-title{font-family:var(--font-head);font-size:1rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em}
        .topbar-right{display:flex;align-items:center;gap:10px}
        .content{padding:28px;flex:1}

        /* CARDS */
        .stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:28px}
        .stat-card{background:var(--bg2);border:1px solid var(--border);border-radius:var(--radius-lg);padding:22px 20px}
        .stat-card-label{font-size:.72rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.1em;margin-bottom:10px}
        .stat-card-num{font-family:var(--font-head);font-size:2.2rem;font-weight:800;line-height:1}
        .stat-card-sub{font-size:.78rem;color:var(--muted);margin-top:6px}
        .stat-card.gold .stat-card-num{color:var(--gold)}
        .stat-card.red  .stat-card-num{color:var(--red)}
        .stat-card.green .stat-card-num{color:var(--green)}

        /* TABLE */
        .card{background:var(--bg2);border:1px solid var(--border);border-radius:var(--radius-lg);overflow:hidden;margin-bottom:24px}
        .card-head{padding:18px 22px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap}
        .card-title{font-family:var(--font-head);font-size:.95rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em}
        table{width:100%;border-collapse:collapse}
        th{font-size:.68rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.1em;padding:12px 16px;text-align:left;border-bottom:1px solid var(--border);white-space:nowrap}
        td{padding:13px 16px;font-size:.875rem;border-bottom:1px solid var(--border);vertical-align:middle}
        tr:last-child td{border-bottom:none}
        tr:hover td{background:rgba(255,255,255,.02)}
        .td-img{width:48px;height:48px;border-radius:var(--radius);overflow:hidden;background:var(--bg3)}
        .td-img img{width:100%;height:100%;object-fit:cover}
        .badge{display:inline-flex;align-items:center;padding:3px 10px;border-radius:100px;font-size:.68rem;font-weight:700;text-transform:uppercase;letter-spacing:.06em}
        .badge-green{background:rgba(62,207,142,.12);color:var(--green);border:1px solid rgba(62,207,142,.25)}
        .badge-yellow{background:rgba(249,115,22,.12);color:#f97316;border:1px solid rgba(249,115,22,.25)}
        .badge-red{background:rgba(224,82,82,.12);color:var(--red);border:1px solid rgba(224,82,82,.25)}

        /* BUTTONS */
        .btn{display:inline-flex;align-items:center;gap:6px;padding:8px 18px;border-radius:var(--radius);font-family:var(--font-body);font-size:.8rem;font-weight:600;letter-spacing:.04em;text-transform:uppercase;cursor:pointer;border:none;transition:all .2s}
        .btn-gold{background:var(--gold);color:#0e0e0f}
        .btn-gold:hover{background:var(--gold2)}
        .btn-ghost{background:transparent;color:var(--muted);border:1px solid var(--border2)}
        .btn-ghost:hover{color:var(--text);border-color:var(--border2)}
        .btn-red{background:rgba(224,82,82,.12);color:var(--red);border:1px solid rgba(224,82,82,.25)}
        .btn-red:hover{background:var(--red);color:#fff}
        .btn-sm{padding:5px 12px;font-size:.72rem}
        .btn-icon{width:30px;height:30px;padding:0;justify-content:center;border-radius:var(--radius)}

        /* FORM */
        .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
        .form-group{display:flex;flex-direction:column;gap:6px;margin-bottom:16px}
        .form-group:last-child{margin-bottom:0}
        .form-label{font-size:.72rem;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.1em}
        .form-label .req{color:var(--red)}
        .form-control{padding:10px 14px;background:var(--bg3);border:1px solid var(--border2);border-radius:var(--radius);color:var(--text);font-family:var(--font-body);font-size:.875rem;outline:none;transition:border .2s;width:100%}
        .form-control::placeholder{color:var(--muted)}
        .form-control:focus{border-color:var(--gold)}
        .form-control.error{border-color:var(--red)}
        textarea.form-control{resize:vertical;min-height:90px}
        .field-error{font-size:.75rem;color:var(--red)}
        .form-section{background:var(--bg2);border:1px solid var(--border);border-radius:var(--radius-lg);overflow:hidden;margin-bottom:20px}
        .form-section-head{padding:16px 22px;border-bottom:1px solid var(--border);font-size:.72rem;font-weight:700;color:var(--gold);text-transform:uppercase;letter-spacing:.12em}
        .form-section-body{padding:22px}
        .form-footer{padding:16px 22px;background:var(--bg3);border-top:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;gap:12px}

        /* UPLOAD */
        .upload-zone{border:1px dashed var(--border2);border-radius:var(--radius);padding:32px 20px;text-align:center;cursor:pointer;transition:all .2s;position:relative;background:var(--bg3)}
        .upload-zone:hover{border-color:var(--gold)}
        .upload-zone input{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
        .upload-icon{font-size:1.5rem;color:var(--muted);margin-bottom:8px}
        .upload-text{font-size:.85rem;font-weight:600;color:var(--text);margin-bottom:4px}
        .upload-hint{font-size:.75rem;color:var(--muted)}
        .preview-img{width:80px;height:80px;object-fit:cover;border-radius:var(--radius);border:1px solid var(--border2);margin-top:12px;display:none}

        /* SEARCH BAR */
        .search-bar{display:flex;align-items:center;gap:10px;flex-wrap:wrap}
        .s-wrap{position:relative}
        .s-wrap i{position:absolute;left:10px;top:50%;transform:translateY(-50%);color:var(--muted);font-size:.75rem}
        .s-input{padding:8px 12px 8px 30px;background:var(--bg3);border:1px solid var(--border2);border-radius:var(--radius);color:var(--text);font-family:var(--font-body);font-size:.82rem;outline:none;width:220px}
        .s-input:focus{border-color:var(--gold)}
        .s-select{padding:8px 12px;background:var(--bg3);border:1px solid var(--border2);border-radius:var(--radius);color:var(--text);font-family:var(--font-body);font-size:.82rem;outline:none;cursor:pointer}

        /* ALERT */
        .alert{padding:12px 16px;border-radius:var(--radius);display:flex;align-items:center;gap:8px;font-size:.85rem;font-weight:500;margin-bottom:20px}
        .alert-success{background:rgba(62,207,142,.1);color:var(--green);border:1px solid rgba(62,207,142,.25)}
        .alert-error{background:rgba(224,82,82,.1);color:var(--red);border:1px solid rgba(224,82,82,.25)}

        /* PAGINATION */
        .pag{display:flex;gap:4px;justify-content:center;margin-top:20px}
        .pag a,.pag span{display:flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:var(--radius);border:1px solid var(--border2);font-size:.8rem;font-weight:600;color:var(--muted);background:var(--surface);transition:all .2s}
        .pag a:hover{border-color:var(--gold);color:var(--gold)}
        .pag .active{background:var(--gold);color:#0e0e0f;border-color:var(--gold)}

        /* MODAL */
        .modal-overlay{display:none;position:fixed;inset:0;z-index:500;background:rgba(0,0,0,.7);backdrop-filter:blur(4px);align-items:center;justify-content:center;padding:20px}
        .modal-overlay.open{display:flex}
        .modal-box{background:var(--bg2);border:1px solid var(--border2);border-radius:var(--radius-lg);max-width:440px;width:100%;padding:28px;position:relative}
        .modal-title{font-family:var(--font-head);font-size:1.1rem;font-weight:800;text-transform:uppercase;margin-bottom:8px}
        .modal-sub{color:var(--muted);font-size:.875rem;margin-bottom:24px}
        .modal-close{position:absolute;top:14px;right:14px;background:none;border:none;color:var(--muted);cursor:pointer;font-size:.9rem}

        @media(max-width:900px){
            .sidebar{transform:translateX(-100%)}
            .main{margin-left:0}
            .stat-grid{grid-template-columns:repeat(2,1fr)}
        }
    </style>
    @yield('head')
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">ZXNTO<span class="dot">.</span></div>
    <nav class="sidebar-nav">
        <div class="sidebar-label">Main</div>
        <a href="/admin" class="sidebar-link {{ request()->is('admin') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>
        <div class="sidebar-label">Catalog</div>
        <a href="/admin/products" class="sidebar-link {{ request()->is('admin/products*') ? 'active' : '' }}">
            <i class="fas fa-shoe-prints"></i> Products
        </a>
        <a href="/admin/categories" class="sidebar-link {{ request()->is('admin/categories*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i> Categories
        </a>
        <a href="/admin/orders" class="sidebar-link {{ request()->is('admin/orders*') ? 'active' : '' }}">
            <i class="fas fa-receipt"></i> Orders
        </a>
        <div class="sidebar-label">Store</div>
        <a href="/" class="sidebar-link"><i class="fas fa-globe"></i> View Site</a>
        <a href="/product" class="sidebar-link"><i class="fas fa-shopping-bag"></i> Shop</a>
    </nav>
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">K</div>
            <div>
                <div class="sidebar-username">Kheang</div>
                <div class="sidebar-role">Administrator</div>
            </div>
        </div>
        <a href="/user/logout" class="btn btn-ghost" style="width:100%;justify-content:center">
            <i class="fas fa-right-from-bracket"></i> Logout
        </a>
    </div>
</aside>

<div class="main">
    <div class="topbar">
        <div class="topbar-title">@yield('page-title','Dashboard')</div>
        <div class="topbar-right">
            <span style="font-size:.8rem;color:var(--muted)">Admin Panel</span>
        </div>
    </div>
    <div class="content">
        @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
</div>

@yield('scripts')
</body>
</html>

