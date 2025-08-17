<x-guest-layout>
    <div class="auth-container">
        <div class="auth-glass-card auth-fade-in">
            <div class="auth-header">
                <h2 class="auth-title">Reset Password</h2>
                <p class="auth-subtitle">Enter your new password below</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="auth-form-group">
                    <label class="auth-label" for="email">{{ __('Email') }}</label>
                    <input id="email" class="auth-input" type="email" name="email" 
                           value="{{ old('email', $request->email) }}" placeholder="Enter your email" 
                           required autofocus autocomplete="username">
                    @error('email')
                        <span class="auth-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="auth-form-group">
                    <label class="auth-label" for="password">{{ __('Password') }}</label>
                    <input id="password" class="auth-input" type="password" name="password" 
                           placeholder="Enter new password" required autocomplete="new-password">
                    @error('password')
                        <span class="auth-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="auth-form-group">
                    <label class="auth-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" class="auth-input" type="password" 
                           name="password_confirmation" placeholder="Confirm new password" 
                           required autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="auth-error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="auth-btn auth-btn-primary">
                    {{ __('Reset Password') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>