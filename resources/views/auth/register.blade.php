<x-guest-layout>

    <h2 class="gl-title">Create account</h2>
    <p class="gl-sub">Free forever. Start tracking in seconds.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="gl-group">
            <label for="name">Full name</label>
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="e.g. Juan dela Cruz" />
            <x-input-error :messages="$errors->get('name')" class="gl-error" />
        </div>

        <div class="gl-group">
            <label for="email">Email address</label>
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@email.com" />
            <x-input-error :messages="$errors->get('email')" class="gl-error" />
        </div>

        <div class="gl-group">
            <label for="password">Password</label>
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Min. 8 characters" />
            <x-input-error :messages="$errors->get('password')" class="gl-error" />
        </div>

        <div class="gl-group">
            <label for="password_confirmation">Confirm password</label>
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="gl-error" />
        </div>

        <button type="submit" class="gl-btn" style="margin-top:4px;">Create my account</button>

        <div class="gl-bottom">
            Already have an account?
            <a href="{{ route('login') }}">Sign in</a>
        </div>
    </form>

</x-guest-layout>