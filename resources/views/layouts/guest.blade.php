<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Financial Tracker') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&display=swap');

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            background: #f0f4ff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            position: relative;
            overflow: hidden;
        }

        .bg-circle {
            position: fixed; border-radius: 50%;
            pointer-events: none; z-index: 0;
        }
        .bg-circle-1 { width: 600px; height: 600px; background: radial-gradient(circle, rgba(99,102,241,0.12), transparent 70%); top: -200px; right: -150px; }
        .bg-circle-2 { width: 500px; height: 500px; background: radial-gradient(circle, rgba(16,185,129,0.08), transparent 70%); bottom: -150px; left: -100px; }

        .gl-card {
            position: relative; z-index: 1;
            width: 100%; max-width: 460px;
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 8px 40px rgba(99,102,241,0.12), 0 1px 4px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .gl-card-top {
            height: 5px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6, #06b6d4);
        }

        .gl-card-body { padding: 40px; }

        .gl-logo {
            display: flex; align-items: center; gap: 10px;
            text-decoration: none; margin-bottom: 32px;
        }
        .gl-logo img { width: 30px; height: 30px; object-fit: contain; }
        .gl-logo-name { font-size: 14px; font-weight: 700; color: #111827; }

        .gl-title { font-size: 24px; font-weight: 800; color: #111827; letter-spacing: -0.5px; margin-bottom: 6px; }
        .gl-sub { font-size: 13.5px; color: #9ca3af; margin-bottom: 28px; }

        .gl-group { margin-bottom: 16px; }

        .gl-group label {
            display: block; font-size: 12.5px; font-weight: 600;
            color: #374151; margin-bottom: 6px;
        }

        .gl-group input[type="text"],
        .gl-group input[type="email"],
        .gl-group input[type="password"] {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            font-size: 13.5px;
            color: #111827;
            background: #fafafa;
            outline: none;
            font-family: 'DM Sans', sans-serif;
            transition: border-color 0.15s, background 0.15s, box-shadow 0.15s;
        }

        .gl-group input[type="text"]:focus,
        .gl-group input[type="email"]:focus,
        .gl-group input[type="password"]:focus {
            border-color: #6366f1;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
        }

        .gl-error { font-size: 12px; color: #ef4444; margin-top: 5px; }

        .gl-remember {
            display: flex; align-items: center; gap: 8px;
            margin-bottom: 22px;
        }
        .gl-remember input[type="checkbox"] {
            width: 15px; height: 15px;
            accent-color: #6366f1; cursor: pointer;
        }
        .gl-remember span { font-size: 13px; color: #6b7280; }

        .gl-label-row {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 6px;
        }
        .gl-label-row label { margin-bottom: 0 !important; }
        .gl-forgot { font-size: 12px; color: #6366f1; font-weight: 600; text-decoration: none; }
        .gl-forgot:hover { text-decoration: underline; }

        .gl-btn {
            width: 100%; padding: 12px 0;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff; font-size: 14px; font-weight: 700;
            border: none; border-radius: 10px; cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            box-shadow: 0 4px 16px rgba(99,102,241,0.35);
            transition: opacity 0.15s, transform 0.15s;
            letter-spacing: 0.01em;
        }
        .gl-btn:hover { opacity: 0.92; transform: translateY(-1px); }

        .gl-bottom {
            text-align: center; margin-top: 20px;
            font-size: 13px; color: #9ca3af;
        }
        .gl-bottom a { color: #6366f1; font-weight: 600; text-decoration: none; }
        .gl-bottom a:hover { text-decoration: underline; }

        .gl-divider {
            display: flex; align-items: center; gap: 12px;
            margin: 20px 0;
        }
        .gl-divider-line { flex: 1; height: 1px; background: #f0f0f2; }
        .gl-divider-text { font-size: 11.5px; color: #d1d5db; font-weight: 500; }

        .gl-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    </style>
</head>
<body>

    <div class="bg-circle bg-circle-1"></div>
    <div class="bg-circle bg-circle-2"></div>

    <div class="gl-card">
        <div class="gl-card-top"></div>
        <div class="gl-card-body">

            <a href="/" class="gl-logo">
                <img src="{{ asset('image/logo.png') }}" alt="Logo">
                <span class="gl-logo-name">Financial Tracker</span>
            </a>

            {{ $slot }}

        </div>
    </div>

</body>
</html>