<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Financial Tracking System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 min-h-screen flex flex-col">

    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-2">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" class="w-10 h-10">
                    <span class="font-bold text-lg text-gray-900">Financial Tracker</span>
                </a>
            </div>
            <div class="flex items-center space-x-6">
                @if (Route::has('login'))
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 font-medium px-3 py-1 transition-colors">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600 font-medium px-3 py-1 transition-colors rounded hover:bg-gray-100">Register</a>
                    @endif
                @endif
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center p-8 bg-gradient-to-r from-green-100 via-blue-100 to-indigo-100">
        <div class="text-center max-w-2xl">
            <h1 class="text-5xl font-extrabold text-gray-900 mb-6">
                Track Your Finances Smarter 
            </h1>
            <p class="text-xl text-gray-700 mb-4">
                Welcome to the Financial Tracking System — your partner in managing income, expenses, and savings.
            </p>
            <p class="text-lg text-gray-600 mb-8">
                Stay organized, monitor transactions, and make better financial decisions with ease.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" class="px-6 py-3 bg-gray-800 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                    Get Started
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-indigo-600 border border-indigo-600 rounded-lg shadow hover:bg-indigo-50 transition">
                        Create Account
                    </a>
                @endif
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow mt-auto">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-gray-600">
            © {{ date('Y') }} Financial Tracking System. All rights reserved.
        </div>
    </footer>

</body>
</html>
