@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrendingVlogs - Modern Social Feed</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/trending-vlogs.css') }}">
</head>

<body>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 animate-float">
                Trending Vlogs
            </h1>
            <p class="text-xl text-white/80 max-w-2xl mx-auto">
                Discover amazing content from trending in CAMBODIA 🇰🇭
            </p>
        </div>

        <!-- Search & Filter -->
        <div class="glass-card max-w-4xl mx-auto mb-8">
            <form method="GET" action="{{ route('home') }}" class="flex flex-col md:flex-row gap-4">
                @csrf
                <div class="flex-1">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Search posts..." 
                           class="glass-input w-full">
                </div>
                <button type="submit" class="glass-button whitespace-nowrap">
                    Search
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Left Sidebar -->
            <div class="hidden lg:block space-y-4">
                <!-- Trending Topics -->
                <div class="glass-card">
                    <h3 class="font-semibold text-white mb-4 flex items-center">
                        🇰🇭 Cambodia Trending
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-white/80">#CambodianVlogs</span>
                            <span class="text-blue-400 text-sm">2.4k posts</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-white/80">#PhnomPenh</span>
                            <span class="text-purple-400 text-sm">1.8k posts</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-white/80">#SiemReap</span>
                            <span class="text-pink-400 text-sm">956 posts</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Posts Grid -->
                <div class="grid grid-cols-1 gap-8">
                    @forelse($posts as $post)
                        <article class="glass-card group hover:animate-glow slide-up">
                            <!-- Post Images -->
                            @if($post->image_urls && count($post->image_urls) > 0)
                                <div class="relative mb-4 overflow-hidden rounded-2xl {{ count($post->image_urls) === 2 ? 'grid gap-1 grid-cols-2' : '' }}">
                                    @if(count($post->image_urls) === 2)
                                        @foreach($post->image_urls as $imageUrl)
                                            <img src="{{ $imageUrl }}" 
                                                 alt="{{ $post->title }}"
                                                 class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
                                        @endforeach
                                    @else
                                        <img src="{{ $post->image_urls[0] }}" 
                                             alt="{{ $post->title }}"
                                             class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
                                        @if(count($post->image_urls) > 1)
                                            <div class="absolute top-2 right-2 glass rounded-full px-2 py-1 text-sm text-white">
                                                +{{ count($post->image_urls) - 1 }}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            @endif

                            <!-- Post Content -->
                            <div class="space-y-3">
                                <h3 class="text-xl font-semibold text-white line-clamp-2">
                                    <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-300 transition-colors">
                                        {{ $post->title }}
                                    </a>
                                </h3>
                                
                                <p class="text-white/70 line-clamp-3">
                                    {{ Str::limit($post->body, 150) }}
                                </p>

                                <!-- Author & Date -->
                                <div class="flex items-center justify-between text-sm text-white/60">
                                    <span>by {{ $post->user->name }}</span>
                                    <span>{{ $post->created_at->diffForHumans() }}</span>
                                </div>

                                <!-- Stats -->
                                <div class="flex items-center justify-between pt-3 border-t border-white/20">
                                    <div class="flex items-center space-x-4 text-sm text-white/80">
                                        <span class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>{{ $post->views_count ?? 0 }}</span>
                                        </span>
                                        <span class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>{{ $post->reactions_count ?? 0 }}</span>
                                        </span>
                                        <span class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                                            </svg>
                                            <span>{{ $post->comments_count ?? 0 }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <!-- No Posts Message -->
                        <div class="text-center py-12">
                            <div class="glass-card max-w-md mx-auto">
                                <h3 class="text-2xl font-semibold text-white mb-2">No posts found</h3>
                                <p class="text-white/70 mb-4">Be the first to share your story!</p>
                                @auth
                                    <a href="{{ route('posts.create') }}" class="glass-button">
                                        Create Post
                                    </a>
                                @else
                                    <a href="{{ route('register') }}" class="glass-button">
                                        Join Now
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($posts->hasPages())
                    <div class="text-center mt-8">
                        <div class="glass-card inline-block">
                            {{ $posts->links() }}
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Sidebar -->
            <div class="hidden lg:block space-y-4">
                <!-- Advertisement -->
<div class="glass-card">
    <h3 class="font-semibold text-white mb-4">Advertisement</h3>
    <div class="space-y-4">
        <!-- Example Sponsor Ad 1 -->
        <a href="https://sponsor-website.com" target="_blank" class="block rounded-xl overflow-hidden hover:opacity-90 transition">
            <img src="{{ asset('/storage/posts/D5mfzVwBQZNTxMWJsNUSz4xcNI94l0CWINem3SJv.jpg') }}" alt="Sponsor Ad 1" class="w-full h-32 object-cover rounded-xl shadow-lg">
        </a>

        <!-- Example Sponsor Ad 2 -->
        <a href="https://another-sponsor.com" target="_blank" class="block rounded-xl overflow-hidden hover:opacity-90 transition">
            <img src="{{ asset('/storage/posts/ZmzKnUvrI8LpsUhq6E0nBmGfFOfzWr7dEZQA5AiL.jpg') }}" alt="Sponsor Ad 2" class="w-full h-32 object-cover rounded-xl shadow-lg">
        </a>

        <!-- Example Sponsor Ad 3 -->
        <a href="https://third-sponsor.com" target="_blank" class="block rounded-xl overflow-hidden hover:opacity-90 transition">
            <img src="{{ asset('/storage/posts/KhGPtow3gpFvSZ61LQEpiT1LE8c0c4FDx3Jy0oWc.jpg') }}" alt="Sponsor Ad 3" class="w-full h-32 object-cover rounded-xl shadow-lg">
        </a>
    </div>
</div>

            </div>
        </div>
    </div>

    <!-- Floating Action Button (Mobile) -->
    @auth
        <a href="{{ route('posts.create') }}" class="lg:hidden fixed bottom-6 right-6 w-14 h-14 btn-primary rounded-full flex items-center justify-center shadow-2xl z-50 animate-float">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
        </a>
    @endauth

    <!-- Minimal JavaScript for interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for anchor links
            document.addEventListener('click', function(e) {
                if (e.target.matches('a[href^="#"]')) {
                    e.preventDefault();
                    const target = document.querySelector(e.target.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + K for search focus
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    const searchInput = document.querySelector('input[name="search"]');
                    if (searchInput) {
                        searchInput.focus();
                        searchInput.select();
                    }
                }
            });

            // Enhanced focus states for accessibility
            const inputs = document.querySelectorAll('.glass-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.style.boxShadow = '0 0 0 2px rgba(59, 130, 246, 0.5)';
                });
                
                input.addEventListener('blur', function() {
                    this.style.boxShadow = '';
                });
            });

            // Stagger animations for posts on page load
            const posts = document.querySelectorAll('.slide-up');
            posts.forEach((post, index) => {
                post.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>
@endsection
