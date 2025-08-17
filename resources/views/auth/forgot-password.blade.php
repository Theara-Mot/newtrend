<x-guest-layout>
    <div class="auth-container">
        <div class="auth-glass-card auth-fade-in">
            <div class="auth-header">
                <h2 class="auth-title">Reset Password</h2>
                <p class="auth-subtitle">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="auth-status auth-status-success">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="auth-form-group">
                    <label class="auth-label" for="email">{{ __('Email') }}</label>
                    <input id="email" class="auth-input" type="email" name="email" 
                           value="{{ old('email') }}" placeholder="Enter your email" 
                           required autofocus>
                    @error('email')
                        <span class="auth-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="auth-btn auth-btn-primary">
                    {{ __('Email Password Reset Link') }}
                </button>

                <div class="auth-switch">
                    {{ __('Remember your password?') }}
                    <a href="{{ route('login') }}" class="auth-switch-link">{{ __('Back to login') }}</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>