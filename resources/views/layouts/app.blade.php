<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* iOS Liquid Glass Styles */
        :root {
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            --glass-blur: blur(20px);
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-tertiary: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            background-attachment: fixed;
        }
        
        .glass {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
        }
        
        .glass-card {
            @apply glass rounded-3xl p-6 transition-all duration-300 hover:scale-[1.02];
        }
        
        .glass-button {
            @apply glass rounded-2xl px-6 py-3 font-medium text-white transition-all duration-300 hover:bg-white/20 active:scale-95;
        }
        
        .glass-input {
            @apply glass rounded-2xl px-4 py-3 text-white placeholder-white/70 border-white/30 focus:border-white/50 focus:ring-0 bg-white/10;
        }
        
        .floating-nav {
            @apply fixed bottom-6 left-1/2 transform -translate-x-1/2 glass rounded-full px-6 py-3 z-50;
        }
        
        .reaction-button {
            @apply glass rounded-full p-3 text-xl transition-all duration-300 hover:scale-110 active:scale-95;
        }
        
        .status-badge {
            @apply glass rounded-full px-4 py-2 text-sm font-medium;
        }
        
        /* Animation classes */
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-glow {
            animation: glow 2s ease-in-out infinite alternate;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes glow {
            from { box-shadow: 0 0 20px rgba(255, 255, 255, 0.2); }
            to { box-shadow: 0 0 30px rgba(255, 255, 255, 0.4); }
        }
        
        /* Scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
        
        /* Mobile responsiveness */
        @media (max-width: 640px) {
            .glass-card {
                @apply rounded-2xl p-4;
            }
        }
    </style>
</head>

<body class="antialiased">
    <div id="app" class="min-h-screen">
        <!-- Navigation -->
        <nav class="glass sticky top-0 z-40 border-b border-white/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-white">
                            New Trending
                        </a>
                    </div>

                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('home') }}" class="text-white/80 hover:text-white transition-colors">
                            Home
                        </a>
                        @auth
                            <a href="{{ route('posts.create') }}" class="glass-button">
                                Create Post
                            </a>
                            <a href="{{ route('posts.my') }}" class="text-white/80 hover:text-white transition-colors">
                                My Posts
                            </a>
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="text-white/80 hover:text-white transition-colors">
                                    Admin
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-white/80 hover:text-white transition-colors">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-white/80 hover:text-white transition-colors">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="glass-button">
                                Register
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button id="mobile-menu-button" class="glass-button p-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden glass-card m-4">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('home') }}" class="block px-3 py-2 text-white/80 hover:text-white">Home</a>
                    @auth
                        <a href="{{ route('posts.create') }}" class="block px-3 py-2 text-white/80 hover:text-white">Create Post</a>
                        <a href="{{ route('posts.my') }}" class="block px-3 py-2 text-white/80 hover:text-white">My Posts</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-white/80 hover:text-white">Admin</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 text-white/80 hover:text-white">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2 text-white/80 hover:text-white">Login</a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 text-white/80 hover:text-white">Register</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="fixed top-20 right-4 glass-card bg-green-500/20 border-green-400/30 text-white z-50 animate-glow" id="flash-message">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="fixed top-20 right-4 glass-card bg-red-500/20 border-red-400/30 text-white z-50 animate-glow" id="flash-message">
                {{ session('error') }}
            </div>
        @endif

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </main>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Auto-hide flash messages
        setTimeout(() => {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.opacity = '0';
                flashMessage.style.transform = 'translateY(-20px)';
                setTimeout(() => flashMessage.remove(), 300);
            }
        }, 3000);

        // CSRF token for AJAX requests
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };
    </script>
</body>
</html>