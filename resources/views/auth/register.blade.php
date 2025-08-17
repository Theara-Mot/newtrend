<x-guest-layout>
    <div class="auth-container">
        <div class="auth-glass-card auth-fade-in">
            <div class="auth-header">
                <h2 class="auth-title">Create Account</h2>
                <p class="auth-subtitle">Join us today and get started</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="auth-form-group">
                    <label class="auth-label" for="name">{{ __('Name') }}</label>
                    <input id="name" class="auth-input" type="text" name="name" 
                           value="{{ old('name') }}" placeholder="Enter your full name" 
                           required autofocus autocomplete="name">
                    @error('name')
                        <span class="auth-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="auth-form-group">
                    <label class="auth-label" for="email">{{ __('Email') }}</label>
                    <input id="email" class="auth-input" type="email" name="email" 
                           value="{{ old('email') }}" placeholder="Enter your email" 
                           required autocomplete="username">
                    @error('email')
                        <span class="auth-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="auth-form-group">
                    <label class="auth-label" for="password">{{ __('Password') }}</label>
                    <input id="password" class="auth-input" type="password" name="password" 
                           placeholder="Create a password" required autocomplete="new-password">
                    @error('password')
                        <span class="auth-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="auth-form-group">
                    <label class="auth-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" class="auth-input" type="password" 
                           name="password_confirmation" placeholder="Confirm your password" 
                           required autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="auth-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="auth-btn auth-btn-primary">
                    {{ __('Register') }}
                </button>

                <div class="auth-switch">
                    {{ __('Already registered?') }}
                    <a href="{{ route('login') }}" class="auth-switch-link">{{ __('Sign in') }}</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>