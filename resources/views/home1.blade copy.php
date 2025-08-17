@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="text-center">
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-4 animate-float">
            Trending Vlogs
        </h1>
        <p class="text-xl text-white/80 max-w-2xl mx-auto">
            Discover amazing content from trending in CAMBODIA 🇰🇭
        </p>
    </div>

    <!-- Search & Filter -->
    <div class="glass-card max-w-4xl mx-auto">
        <form method="GET" action="{{ route('home') }}" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Search posts..." 
                       class="glass-input w-full">
            </div>
            <div>
                <select name="sort" class="glass-input">
                    <option value="trending" {{ request('sort') === 'trending' ? 'selected' : '' }}>Trending</option>
                    <option value="recent" {{ request('sort') === 'recent' ? 'selected' : '' }}>Recent</option>
                    <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>Popular</option>
                </select>
            </div>
            <button type="submit" class="glass-button whitespace-nowrap">
                Search
            </button>
        </form>
    </div>

    <!-- Posts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <article class="glass-card group hover:animate-glow">
                <!-- Post Images -->
                @if($post->image_urls)
                    <div class="relative mb-4 overflow-hidden rounded-2xl">
                        <img src="{{ $post->image_urls[0] }}" 
                             alt="{{ $post->title }}"
                             class="w-full h-48 object-cover transition-transform duration-300 group-hover:scale-110">
                        @if(count($post->image_urls) > 1)
                            <div class="absolute top-2 right-2 glass rounded-full px-2 py-1 text-sm text-white">
                                +{{ count($post->image_urls) - 1 }}
                            </div>
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
                                <span>{{ $post->views_count }}</span>
                            </span>
                            <span class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $post->reactions_count }}</span>
                            </span>
                            <span class="flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $post->comments_count }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center py-12">
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
        <div class="flex justify-center">
            <div class="glass-card">
                {{ $posts->links() }}
            </div>
        </div>
    @endif
</div>
@endsection