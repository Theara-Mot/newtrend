<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trending</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated background bubbles */
        .bg-bubbles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .bubble {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
            animation: float 15s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.3; }
            50% { transform: translateY(-100vh) rotate(360deg); opacity: 0.8; }
        }

        .container {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Glass morphism card */
        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-title {
            color: white;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 8px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .form-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
            line-height: 1.5;
        }

        /* Input styling */
        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-label {
            display: block;
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .input-field {
            width: 100%;
            padding: 15px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            font-size: 16px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .input-field::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .input-field:focus {
            outline: none;
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.4);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        /* Checkbox styling */
        .checkbox-group {
            display: flex;
            align-items: center;
            margin: 20px 0;
        }

        .checkbox {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            accent-color: rgba(255, 255, 255, 0.8);
        }

        .checkbox-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }

        /* Button styling */
        .btn {
            width: 100%;
            padding: 16px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
        }

        .btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        /* Link styling */
        .link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .link:hover {
            color: white;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .form-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Form switcher */
        .form-switcher {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 4px;
        }

        .switch-btn {
            flex: 1;
            padding: 12px;
            background: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 14px;
            font-weight: 500;
        }

        .switch-btn.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .form-section {
            display: none;
        }

        .form-section.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .status-message {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .status-success {
            background: rgba(34, 197, 94, 0.2);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: rgb(34, 197, 94);
        }

        .status-error {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: rgb(239, 68, 68);
        }

        @media (max-width: 480px) {
            .glass-card {
                padding: 30px 20px;
                margin: 10px;
            }
            
            .form-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <!-- Animated background bubbles -->
    <div class="bg-bubbles" id="bubbles"></div>

    <div class="container">
        <div class="glass-card">
            <!-- Form switcher -->
            <div class="form-switcher">
                <button class="switch-btn active" onclick="switchForm('login')">Sign In</button>
                <button class="switch-btn" onclick="switchForm('register')">Sign Up</button>
                <button class="switch-btn" onclick="switchForm('forgot')">Reset</button>
            </div>

            <!-- Login Form -->
            <div class="form-section active" id="loginn">
                <div class="form-header">
                    <h2 class="form-title">Welcome Back</h2>
                    <p class="form-subtitle">Sign in to your account</p>
                </div>

                <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <label class="input-label">Email</label>
                    <input type="email" name="email" class="input-field" placeholder="Enter your email" required>
                </div>

                <div class="input-group">
                    <label class="input-label">Password</label>
                    <input type="password" name="password" class="input-field" placeholder="Enter your password" required>
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="remember" name="remember" class="checkbox">
                    <label for="remember" class="checkbox-label">Remember me</label>
                </div>

                <button type="submit" class="btn">Sign In</button>

                <div class="form-footer">
                    <a href="#" class="link" onclick="switchForm('forgot')">Forgot your password?</a>
                </div>
            </form>


            </div>

            <!-- Register Form -->
            <div class="form-section" id="register">
                <div class="form-header">
                    <h2 class="form-title">Create Account</h2>
                    <p class="form-subtitle">Join us today</p>
                </div>

                <form>
                    <div class="input-group">
                        <label class="input-label">Name</label>
                        <input type="text" class="input-field" placeholder="Enter your full name" required>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Email</label>
                        <input type="email" class="input-field" placeholder="Enter your email" required>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Password</label>
                        <input type="password" class="input-field" placeholder="Create a password" required>
                    </div>

                    <div class="input-group">
                        <label class="input-label">Confirm Password</label>
                        <input type="password" class="input-field" placeholder="Confirm your password" required>
                    </div>

                    <button type="submit" class="btn">Create Account</button>

                    <div class="form-footer">
                        <span style="color: rgba(255, 255, 255, 0.8);">Already have an account? </span>
                        <a href="#" class="link" onclick="switchForm('login')">Sign in</a>
                    </div>
                </form>
            </div>

            <!-- Forgot Password Form -->
            <div class="form-section" id="forgot">
                <div class="form-header">
                    <h2 class="form-title">Reset Password</h2>
                    <p class="form-subtitle">Enter your email to receive a reset link</p>
                </div>

                <form>
                    <div class="input-group">
                        <label class="input-label">Email</label>
                        <input type="email" class="input-field" placeholder="Enter your email" required>
                    </div>

                    <button type="submit" class="btn">Send Reset Link</button>

                    <div class="form-footer">
                        <a href="#" class="link" onclick="switchForm('login')">← Back to Sign In</a>
                    </div>
                </form>
            </div>

            <!-- Email Verification (example) -->
            <div class="form-section" id="verify">
                <div class="form-header">
                    <h2 class="form-title">Verify Email</h2>
                    <p class="form-subtitle">Check your email for a verification link</p>
                </div>

                <div class="status-message status-success">
                    A verification link has been sent to your email address.
                </div>

                <button type="button" class="btn" style="margin-bottom: 15px;">Resend Verification Email</button>
                <button type="button" class="btn" onclick="switchForm('login')">Sign Out</button>
            </div>
        </div>
    </div>

    <!-- <script>
        // Create floating bubbles
        function createBubbles() {
            const bubblesContainer = document.getElementById('bubbles');
            const bubbleCount = 15;

            for (let i = 0; i < bubbleCount; i++) {
                const bubble = document.createElement('div');
                bubble.className = 'bubble';
                
                const size = Math.random() * 60 + 20;
                bubble.style.width = size + 'px';
                bubble.style.height = size + 'px';
                bubble.style.left = Math.random() * 100 + '%';
                bubble.style.animationDelay = Math.random() * 15 + 's';
                bubble.style.animationDuration = (Math.random() * 10 + 10) + 's';
                
                bubblesContainer.appendChild(bubble);
            }
        }

        // Switch between forms
        function switchForm(formName) {
            // Hide all forms
            const forms = document.querySelectorAll('.form-section');
            forms.forEach(form => form.classList.remove('active'));

            // Show selected form
            document.getElementById(formName).classList.add('active');

            // Update button states
            const buttons = document.querySelectorAll('.switch-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            
            const activeButton = Array.from(buttons).find(btn => 
                btn.textContent.toLowerCase().includes(formName === 'forgot' ? 'reset' : formName)
            );
            if (activeButton) {
                activeButton.classList.add('active');
            }
        }

        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            createBubbles();

            // Add floating effect to inputs
            const inputs = document.querySelectorAll('.input-field');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.transform = 'translateY(-1px)';
                });
                
                input.addEventListener('blur', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Simulate form submissions with status messages
            const forms = document.querySelectorAll('form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Add a success message example
                    const header = this.parentNode.querySelector('.form-header');
                    const existingMessage = this.parentNode.querySelector('.status-message');
                    
                    if (existingMessage) {
                        existingMessage.remove();
                    }

                    const message = document.createElement('div');
                    message.className = 'status-message status-success';
                    message.textContent = 'Form submitted successfully! (Demo)';
                    header.insertAdjacentElement('afterend', message);

                    setTimeout(() => {
                        message.remove();
                    }, 3000);
                });
            });
        });

        // Add parallax effect to glass card
        document.addEventListener('mousemove', function(e) {
            const card = document.querySelector('.glass-card');
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            const rotateX = (y / rect.height) * 5;
            const rotateY = (x / rect.width) * -5;
            
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });

        document.addEventListener('mouseleave', function() {
            const card = document.querySelector('.glass-card');
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg)';
        });
    </script> -->
</body>
</html>