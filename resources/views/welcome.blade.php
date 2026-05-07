<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Financial Tracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f0f4ff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        /* Soft bg blobs */
        .bg-blob {
            position: fixed; border-radius: 50%;
            pointer-events: none; z-index: 0;
            filter: blur(100px);
        }
        .bg-blob-1 { width: 600px; height: 600px; background: radial-gradient(circle, rgba(99,102,241,0.18), transparent 70%); top: -200px; right: -100px; }
        .bg-blob-2 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(16,185,129,0.1), transparent 70%); bottom: -150px; left: -80px; }
        .bg-blob-3 { width: 400px; height: 400px; background: radial-gradient(circle, rgba(139,92,246,0.1), transparent 70%); top: 40%; left: 30%; }

        /* ── HEADER ── */
        .wl-header {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            padding: 14px 40px;
            display: flex; align-items: center; justify-content: space-between;
            background: rgba(240,244,255,0.75);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(99,102,241,0.1);
        }

        .wl-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .wl-logo img { width: 32px; height: 32px; object-fit: contain; }
        .wl-logo-name { font-size: 15px; font-weight: 700; color: #111827; letter-spacing: -0.3px; }
        .wl-logo-sub { font-size: 10.5px; color: #9ca3af; }

        .wl-nav { display: flex; align-items: center; gap: 10px; }

        .wl-btn-outline {
            padding: 8px 18px; border-radius: 8px; font-size: 13.5px; font-weight: 600;
            color: #374151; text-decoration: none;
            border: 1.5px solid #e5e7eb; background: #fff;
            transition: border-color 0.15s, background 0.15s;
        }
        .wl-btn-outline:hover { border-color: #6366f1; color: #6366f1; }

        .wl-btn-solid {
            padding: 8px 20px; border-radius: 8px; font-size: 13.5px; font-weight: 700;
            color: #fff; text-decoration: none;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            box-shadow: 0 4px 14px rgba(99,102,241,0.3);
            transition: opacity 0.15s, transform 0.15s;
        }
        .wl-btn-solid:hover { opacity: 0.9; transform: translateY(-1px); }

        /* ── HERO ── */
        .wl-hero {
            flex: 1;
            display: flex; align-items: center; justify-content: center;
            padding: 140px 40px 100px;
            position: relative; text-align: center;
            z-index: 1;
        }

        .wl-hero-inner { max-width: 720px; }

        .wl-hero-pill {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(99,102,241,0.08); border: 1px solid rgba(99,102,241,0.2);
            color: #6366f1; font-size: 12px; font-weight: 600;
            padding: 6px 16px; border-radius: 999px; margin-bottom: 32px;
            letter-spacing: 0.04em; text-transform: uppercase;
        }
        .wl-hero-pill-dot { width: 6px; height: 6px; border-radius: 50%; background: #10b981; box-shadow: 0 0 8px #10b981; }

        .wl-hero h1 {
            font-size: 58px; font-weight: 800; color: #111827;
            letter-spacing: -2px; line-height: 1.05; margin-bottom: 22px;
        }

        .wl-hero h1 .grad {
            background: linear-gradient(90deg, #6366f1, #8b5cf6, #06b6d4);
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        }

        .wl-hero p {
            font-size: 17px; color: #6b7280;
            line-height: 1.7; margin-bottom: 40px;
            max-width: 520px; margin-left: auto; margin-right: auto;
        }

        .wl-hero-cta { display: flex; align-items: center; justify-content: center; gap: 12px; flex-wrap: wrap; }

        .wl-cta-main {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 13px 30px; border-radius: 10px; font-size: 14.5px; font-weight: 700;
            color: #fff; text-decoration: none;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            box-shadow: 0 8px 24px rgba(99,102,241,0.35);
            transition: transform 0.15s, box-shadow 0.15s;
        }
        .wl-cta-main:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(99,102,241,0.45); }

        .wl-cta-sub {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 13px 30px; border-radius: 10px; font-size: 14.5px; font-weight: 600;
            color: #374151; text-decoration: none;
            border: 1.5px solid #e5e7eb; background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            transition: border-color 0.15s, transform 0.15s;
        }
        .wl-cta-sub:hover { border-color: #6366f1; color: #6366f1; transform: translateY(-2px); }

        /* ── STATS STRIP ── */
        .wl-stats {
            position: relative; z-index: 1;
            background: #fff;
            border-top: 1px solid #f0f0f2;
            border-bottom: 1px solid #f0f0f2;
            padding: 32px 40px;
            display: flex; align-items: center; justify-content: center;
        }

        .wl-stat {
            text-align: center; padding: 0 52px;
            border-right: 1px solid #f0f0f2;
        }
        .wl-stat:last-child { border-right: none; }

        .wl-stat-num {
            font-family: 'DM Mono', monospace;
            font-size: 28px; font-weight: 700; color: #111827;
            letter-spacing: -1px; margin-bottom: 4px;
        }
        .wl-stat-label { font-size: 12px; color: #9ca3af; font-weight: 500; }

        /* ── FEATURES ── */
        .wl-features {
            position: relative; z-index: 1;
            padding: 80px 40px;
            max-width: 1060px; margin: 0 auto; width: 100%;
        }

        .wl-section-label {
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            letter-spacing: 0.12em; color: #9ca3af; margin-bottom: 10px;
        }

        .wl-section-title {
            font-size: 30px; font-weight: 800; color: #111827;
            letter-spacing: -0.6px; margin-bottom: 48px;
            max-width: 460px; line-height: 1.2;
        }

        .wl-features-grid {
            display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px;
        }

        .wl-feat {
            background: #fff;
            border: 1px solid #f0f0f2;
            border-radius: 16px; padding: 28px;
            box-shadow: 0 2px 12px rgba(99,102,241,0.05);
            transition: box-shadow 0.15s, border-color 0.15s, transform 0.15s;
        }
        .wl-feat:hover {
            box-shadow: 0 8px 28px rgba(99,102,241,0.12);
            border-color: rgba(99,102,241,0.2);
            transform: translateY(-2px);
        }

        .wl-feat-icon {
            width: 42px; height: 42px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
        }

        .wl-feat h3 { font-size: 14.5px; font-weight: 700; color: #111827; margin-bottom: 8px; }
        .wl-feat p  { font-size: 13px; color: #6b7280; line-height: 1.65; }

        /* ── FOOTER ── */
        .wl-footer {
            position: relative; z-index: 1;
            background: #fff;
            border-top: 1px solid #f0f0f2;
            padding: 24px 40px;
            display: flex; align-items: center; justify-content: space-between;
        }

        .wl-footer-left { font-size: 12.5px; color: #9ca3af; }
        .wl-footer-right { display: flex; align-items: center; gap: 6px; }
        .wl-footer-dot { width: 6px; height: 6px; border-radius: 50%; background: #10b981; box-shadow: 0 0 6px #10b981; }
        .wl-footer-status { font-size: 12px; color: #9ca3af; }
    </style>
</head>
<body>

    <div class="bg-blob bg-blob-1"></div>
    <div class="bg-blob bg-blob-2"></div>
    <div class="bg-blob bg-blob-3"></div>

    {{-- Header --}}
    <header class="wl-header">
        <a href="/" class="wl-logo">
            <img src="{{ asset('image/logo.png') }}" alt="Logo">
            <div>
                <div class="wl-logo-name">Financial Tracker</div>
                <div class="wl-logo-sub">Personal Finance</div>
            </div>
        </a>
        <nav class="wl-nav">
            @if (Route::has('login'))
                <a href="{{ route('login') }}" class="wl-btn-outline">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="wl-btn-solid">Get Started →</a>
                @endif
            @endif
        </nav>
    </header>

    {{-- Hero --}}
    <section class="wl-hero">
        <div class="wl-hero-inner">
            <div class="wl-hero-pill">
                <span class="wl-hero-pill-dot"></span>
                Free to use &mdash; No credit card needed
            </div>

            <h1>Your Money.<br><span class="grad">Fully in Control.</span></h1>

            <p>
                Track every peso you earn and spend. Get monthly insights,
                spot bad habits, and build better financial decisions — all in one place.
            </p>

            <div class="wl-hero-cta">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="wl-cta-main">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                        Create Free Account
                    </a>
                @endif
                <a href="{{ route('login') }}" class="wl-cta-sub">
                    Already have an account? Log in
                </a>
            </div>
        </div>
    </section>

    {{-- Stats Strip --}}
    <div class="wl-stats">
        <div class="wl-stat">
            <div class="wl-stat-num">₱0</div>
            <div class="wl-stat-label">Cost to use</div>
        </div>
        <div class="wl-stat">
            <div class="wl-stat-num">12</div>
            <div class="wl-stat-label">Months tracked</div>
        </div>
        <div class="wl-stat">
            <div class="wl-stat-num">100%</div>
            <div class="wl-stat-label">Private & yours</div>
        </div>
        <div class="wl-stat">
            <div class="wl-stat-num">∞</div>
            <div class="wl-stat-label">Transactions</div>
        </div>
    </div>

    {{-- Features --}}
    <section class="wl-features">
        <p class="wl-section-label">Features</p>
        <h2 class="wl-section-title">Built for real everyday budgeting</h2>

        <div class="wl-features-grid">

            <div class="wl-feat">
                <div class="wl-feat-icon" style="background:rgba(99,102,241,0.1);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#6366f1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="3"/><path d="M2 10h20"/></svg>
                </div>
                <h3>Log Transactions</h3>
                <p>Add income and expenses in seconds. Edit or remove them anytime with full history.</p>
            </div>

            <div class="wl-feat">
                <div class="wl-feat-icon" style="background:rgba(16,185,129,0.1);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                </div>
                <h3>Dashboard Overview</h3>
                <p>See your monthly income, expenses, and balance at a glance. Filter by any month.</p>
            </div>

            <div class="wl-feat">
                <div class="wl-feat-icon" style="background:rgba(139,92,246,0.1);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#8b5cf6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                </div>
                <h3>Monthly Reports</h3>
                <p>Visual bar charts show your full year. Instantly see which month you spent the most.</p>
            </div>

            <div class="wl-feat">
                <div class="wl-feat-icon" style="background:rgba(245,158,11,0.1);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                </div>
                <h3>Filter by Date</h3>
                <p>Browse your transactions filtered by month and year — no more scrolling through old records.</p>
            </div>

            <div class="wl-feat">
                <div class="wl-feat-icon" style="background:rgba(6,182,212,0.1);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#06b6d4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
                </div>
                <h3>Total Balance</h3>
                <p>See the grand total of all your remaining money across every month — all in one number.</p>
            </div>

            <div class="wl-feat">
                <div class="wl-feat-icon" style="background:rgba(239,68,68,0.08);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>
                <h3>Private & Secure</h3>
                <p>Your data belongs only to you. Each account is completely separate and private.</p>
            </div>

        </div>
    </section>

    {{-- Footer --}}
    <footer class="wl-footer">
        <div class="wl-footer-left">© {{ date('Y') }} Financial Tracker. All rights reserved.</div>
        <div class="wl-footer-right">
            <span class="wl-footer-dot"></span>
            <span class="wl-footer-status">All systems operational</span>
        </div>
    </footer>

</body>
</html>