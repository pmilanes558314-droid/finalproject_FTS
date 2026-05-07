<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap');

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f6f7f9;
            margin: 0;
        }

        .layout { display: flex; min-height: 100vh; }

        /* Main area */
        .layout-main { flex: 1; display: flex; flex-direction: column; min-height: 100vh; overflow-x: hidden; }

        /* Header */
        .app-header {
            height: 56px;
            background: #fff;
            border-bottom: 1px solid #f0f0f2;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }

        .app-header-title {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            letter-spacing: -0.2px;
        }

        /* Profile Dropdown */
        .profile-dropdown { position: relative; }

        .profile-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 12px;
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            background: #fff;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            transition: background 0.13s, border-color 0.13s;
        }

        .profile-btn:hover { background: #f5f5f7; border-color: #d1d5db; }

        .profile-btn-avatar {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6, #6d28d9);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .profile-btn svg { color: #9ca3af; }

        .profile-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            width: 180px;
            background: #fff;
            border: 1px solid #f0f0f2;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
            overflow: hidden;
            display: none;
            z-index: 50;
        }

        .profile-menu.open { display: block; }

        .profile-menu a,
        .profile-menu button {
            display: block;
            width: 100%;
            padding: 10px 16px;
            text-align: left;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            background: none;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.12s;
        }

        .profile-menu a:hover,
        .profile-menu button:hover { background: #f5f5f7; }

        .profile-menu-divider { height: 1px; background: #f0f0f2; margin: 4px 0; }

        .profile-menu button { color: #ef4444; }
        .profile-menu button:hover { background: #fff1f2; }

        /* Main content */
        .app-content { flex: 1; padding: 28px; }
    </style>
</head>
<body>

    <div class="layout">
        {{-- Sidebar --}}
        @include('layouts.user-navigation')

        {{-- Main --}}
        <div class="layout-main">

            {{-- Header --}}
            <header class="app-header">
                <div class="app-header-title">
                    @isset($header)
                        {{ $header }}
                    @else
                        Dashboard
                    @endisset
                </div>

                {{-- Profile Dropdown --}}
                <div class="profile-dropdown" id="profileDropdown">
                    <button class="profile-btn" onclick="toggleProfile()">
                        <span class="profile-btn-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        {{ Auth::user()->name }}
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>

                    <div class="profile-menu" id="profileMenu">
                        <a href="{{ route('profile.edit') }}">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline;margin-right:7px;vertical-align:middle;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Profile
                        </a>
                        <div class="profile-menu-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline;margin-right:7px;vertical-align:middle;"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="app-content">
                {{ $slot }}
            </main>

        </div>
    </div>

    <script>
        function toggleProfile() {
            document.getElementById('profileMenu').classList.toggle('open');
        }
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('profileDropdown');
            if (!dropdown.contains(e.target)) {
                document.getElementById('profileMenu').classList.remove('open');
            }
        });
    </script>

</body>
</html>