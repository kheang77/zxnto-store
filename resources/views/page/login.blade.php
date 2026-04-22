<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login â€” ZXNTO</title>
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

        .auth-panel {
            display: flex; flex-direction: column; justify-content: center;
            padding: 60px 64px; background: var(--bg2); border-right: 1px solid var(--border);
        }
        .auth-brand {
            font-family: var(--font-head); font-size: 1.4rem; font-weight: 800;
            letter-spacing: .1em; text-transform: uppercase; margin-bottom: 56px;
        }
        .auth-brand .dot { color: var(--gold); }
        .auth-panel h1 { font-family: var(--font-head); font-size: 2.4rem; font-weight: 800; text-transform: uppercase; letter-spacing: -.01em; margin-bottom: 8px; }
        .auth-panel .sub { color: var(--muted); font-size: .875rem; margin-bottom: 40px; }

        .form-group { margin-bottom: 20px; }
        label { display: block; font-size: .72rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .1em; margin-bottom: 8px; }
        .input-wrap { position: relative; }
        .input-wrap i.icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: .8rem; }
        .form-control {
            width: 100%; padding: 12px 14px 12px 40px;
            background: var(--bg3); border: 1px solid var(--border2);
            border-radius: var(--radius); color: var(--text); font-family: var(--font-body);
            font-size: .9rem; outline: none; transition: border .2s;
        }
        .form-control::placeholder { color: var(--muted); }
        .form-control:focus { border-color: var(--gold); background: var(--surface); }
        .toggle-pwd {
            position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; color: var(--muted); font-size: .8rem;
            transition: color .2s;
        }
        .toggle-pwd:hover { color: var(--text); }

        .form-options { display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; font-size: .8rem; }
        .check-label { display: flex; align-items: center; gap: 8px; cursor: pointer; color: var(--muted); }
        .check-label input { accent-color: var(--gold); }
        .form-options a { color: var(--muted); transition: color .2s; }
        .form-options a:hover { color: var(--gold); }

        .btn-submit {
            width: 100%; padding: 13px; background: var(--gold); color: #0e0e0f;
            border: none; border-radius: var(--radius); font-family: var(--font-body);
            font-size: .85rem; font-weight: 700; letter-spacing: .06em; text-transform: uppercase;
            cursor: pointer; transition: all .2s;
        }
        .btn-submit:hover { background: var(--gold2); transform: translateY(-1px); box-shadow: 0 6px 24px rgba(201,168,76,.3); }

        .auth-foot { text-align: center; margin-top: 28px; font-size: .82rem; color: var(--muted); }
        .auth-foot a { color: var(--gold); font-weight: 600; }

        /* Visual side */
        .auth-visual {
            position: relative; overflow: hidden;
            background: var(--bg3);
        }
        .auth-visual img { width: 100%; height: 100%; object-fit: cover; opacity: .4; filter: grayscale(30%); }
        .auth-visual-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(14,14,15,.9) 0%, transparent 60%);
            display: flex; flex-direction: column; justify-content: flex-end; padding: 48px;
        }
        .auth-visual-quote {
            font-family: var(--font-head); font-size: 2rem; font-weight: 800;
            text-transform: uppercase; line-height: 1.1; margin-bottom: 12px;
        }
        .auth-visual-quote span { color: var(--gold); }
        .auth-visual-sub { color: var(--muted); font-size: .875rem; }

        @media (max-width: 768px) {
            .auth-wrap { grid-template-columns: 1fr; }
            .auth-visual { display: none; }
            .auth-panel { padding: 40px 28px; }
        }
    </style>
</head>
<body>
<div class="auth-wrap">
    <div class="auth-panel">
        <div class="auth-brand">ZXNTO<span class="dot">.</span></div>
        <h1>Welcome Back</h1>
        <p class="sub">Sign in with your email to continue</p>

        @if(session('error'))
        <div style="background:rgba(224,82,82,.1);border:1px solid rgba(224,82,82,.3);color:#e05252;padding:12px 16px;border-radius:6px;font-size:.82rem;margin-bottom:24px;display:flex;align-items:center;gap:8px;">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
        @endif

        <form action="{{ url('user/check') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <div class="input-wrap">
                    <i class="fas fa-envelope icon"></i>
                    <input type="email" name="user" class="form-control" placeholder="you@example.com" required>
                </div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <div class="input-wrap">
                    <i class="fas fa-lock icon"></i>
                    <input type="password" id="pwd" name="pwd" class="form-control" placeholder="Enter your password" required>
                    <button type="button" class="toggle-pwd" onclick="togglePwd()"><i class="fas fa-eye" id="eyeIcon"></i></button>
                </div>
            </div>
            <div class="form-options">
                <label class="check-label"><input type="checkbox"> Remember me</label>
                <a href="#">Forgot password?</a>
            </div>
            <button type="submit" class="btn-submit">Sign In</button>
        </form>

        <div class="auth-foot">
            Don't have an account? <a href="{{ url('beltei/register') }}">Create one</a>
        </div>
    </div>

    <div class="auth-visual">
        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=900&q=80" alt="">
        <div class="auth-visual-overlay">
            <div class="auth-visual-quote">Step Into <span>Something</span> Great.</div>
            <div class="auth-visual-sub">Cambodia's premier destination for authentic premium footwear.</div>
        </div>
    </div>
</div>
<script>
function togglePwd() {
    const p = document.getElementById('pwd'), i = document.getElementById('eyeIcon');
    p.type = p.type === 'password' ? 'text' : 'password';
    i.className = p.type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
}
</script>
</body>
</html>

