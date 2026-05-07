<x-guest-layout>

    <h2 class="gl-title">Sign in</h2>
    <p class="gl-sub">Welcome back! Enter your details below.</p>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="gl-group">
            <label for="email">Email address</label>
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@email.com" />
            <x-input-error :messages="$errors->get('email')" class="gl-error" />
        </div>

        <div class="gl-group">
            <div class="gl-label-row">
                <label for="password">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="gl-forgot">Forgot password?</a>
                @endif
            </div>
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="gl-error" />
        </div>

        <div class="gl-remember">
            <input id="remember_me" type="checkbox" name="remember">
            <span>Keep me signed in</span>
        </div>

        <button type="submit" class="gl-btn">Sign in to your account</button>

        <div class="gl-bottom">
            No account yet?
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Create one for free</a>
            @endif
        </div>
    </form>

</x-guest-layout>