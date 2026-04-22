<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register â€” ZXNTO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg:#0e0e0f; --bg2:#161618; --bg3:#1e1e21; --surface:#242428;
            --border:#2e2e33; --border2:#3a3a40; --text:#f0eff0; --muted:#8a8a95;
            --gold:#c9a84c; --gold2:#e8c96a; --red:#e05252; --radius:6px;
            --font-head:'Syne',sans-serif; --font-body:'Inter',sans-serif;
        }
        body { font-family: var(--font-body); background: var(--bg); color: var(--text); min-height: 100vh; display: flex; }
        a { text-decoration: none; color: inherit; }

        .auth-wrap { display: grid; grid-template-columns: 1fr 1fr; min-height: 100vh; width: 100%; }

        .auth-visual {
            position: relative; overflow: hidden; background: var(--bg3);
        }
        .auth-visual img { width: 100%; height: 100%; object-fit: cover; opacity: .4; filter: grayscale(30%); }
        .auth-visual-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(14,14,15,.9) 0%, transparent 60%);
            display: flex; flex-direction: column; justify-content: flex-end; padding: 48px;
        }
        .auth-visual-quote { font-family: var(--font-head); font-size: 2rem; font-weight: 800; text-transform: uppercase; line-height: 1.1; margin-bottom: 12px; }
        .auth-visual-quote span { color: var(--gold); }
        .auth-visual-sub { color: var(--muted); font-size: .875rem; }

        .auth-panel {
            display: flex; flex-direction: column; justify-content: center;
            padding: 60px 64px; background: var(--bg2); border-left: 1px solid var(--border);
            overflow-y: auto;
        }
        .auth-brand { font-family: var(--font-head); font-size: 1.4rem; font-weight: 800; letter-spacing: .1em; text-transform: uppercase; margin-bottom: 56px; }
        .auth-brand .dot { color: var(--gold); }
        .auth-panel h1 { font-family: var(--font-head); font-size: 2.4rem; font-weight: 800; text-transform: uppercase; letter-spacing: -.01em; margin-bottom: 8px; }
        .auth-panel .sub { color: var(--muted); font-size: .875rem; margin-bottom: 40px; }

        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: .72rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .1em; margin-bottom: 8px; }
        .input-wrap { position: relative; }
        .input-wrap i { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: .8rem; }
        .form-control {
            width: 100%; padding: 12px 14px 12px 40px;
            background: var(--bg3); border: 1px solid var(--border2);
            border-radius: var(--radius); color: var(--text); font-family: var(--font-body);
            font-size: .9rem; outline: none; transition: border .2s;
        }
        .form-control::placeholder { color: var(--muted); }
        .form-control:focus { border-color: var(--gold); background: var(--surface); }

        .btn-submit {
            width: 100%; padding: 13px; background: var(--gold); color: #0e0e0f;
            border: none; border-radius: var(--radius); font-family: var(--font-body);
            font-size: .85rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
            cursor: pointer; transition: all .2s; margin-top: 8px;
        }
        .btn-submit:hover { background: var(--gold2); transform: translateY(-1px); box-shadow: 0 6px 24px rgba(201,168,76,.3); }

        .auth-foot { text-align: center; margin-top: 28px; font-size: .82rem; color: var(--muted); }
        .auth-foot a { color: var(--gold); font-weight: 600; }

        @media (max-width: 768px) {
            .auth-wrap { grid-template-columns: 1fr; }
            .auth-visual { display: none; }
            .auth-panel { padding: 40px 28px; }
        }
    </style>
</head>
<body>
<div class="auth-wrap">
    <div class="auth-visual">
        <img src="https://images.unsplash.com/photo-1491553895911-0055eca6402d?auto=format&fit=crop&w=900&q=80" alt="">
        <div class="auth-visual-overlay">
            <div class="auth-visual-quote">Join the <span>Community.</span></div>
            <div class="auth-visual-sub">Get access to exclusive deals, new arrivals, and member-only offers.</div>
        </div>
    </div>

    <div class="auth-panel">
        <div class="auth-brand">ZXNTO<span class="dot">.</span></div>
        <h1>Create Account</h1>
        <p class="sub">Fill in your details to get started</p>

        <form action="{{ url('beltei/register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Full Name</label>
                <div class="input-wrap">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" class="form-control" placeholder="Your full name" required>
                </div>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <div class="input-wrap">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="phone" class="form-control" placeholder="012 345 678" required>
                </div>
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
                </div>
            </div>
            <button type="submit" class="btn-submit">Create Account</button>
        </form>

        <div class="auth-foot">
            Already have an account? <a href="{{ url('user/login') }}">Sign in</a>
        </div>
    </div>
</div>
</body>
</html>

