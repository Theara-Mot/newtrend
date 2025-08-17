@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">My Posts</h1>
        <a href="{{ route('posts.create') }}" class="glass-button">
            Create New Post
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
            <article class="glass-card">
                <!-- Status Badge -->
                <div class="flex items-center justify-between mb-4">
                    <span class="status-badge 
                        @if($post->status === 'approved') bg-green-500/20 border-green-400/30 text-green-100
                        @elseif($post->status === 'pending') bg-yellow-500/20 border-yellow-400/30 text-yellow-100
                        @else bg-red-500/20 border-red-400/30 text-red-100
                        @endif">
                        {{ ucfirst($post->status) }}
                    </span>
                    <span class="text-white/60 text-sm">{{ $post->created_at->format('M d, Y') }}</span>
                </div>

                <!-- Post Image -->
                @if($post->image_urls)
                    <div class="mb-4 overflow-hidden rounded-2xl">
                        <img src="{{ $post->image_urls[0] }}" 
                             alt="{{ $post->title }}"
                             class="w-full h-40 object-cover">
                    </div>
                @endif

                <!-- Post Content -->
                <div class="space-y-3">
                    <h3 class="text-xl font-semibold text-white">{{ $post->title }}</h3>
                    <p class="text-white/70 line-clamp-3">{{ Str::limit($post->body, 120) }}</p>

                    <!-- Stats -->
                    <div class="flex items-center space-x-4 text-sm text-white/60">
                        <span>{{ $post->views_count }} views</span>
                        <span>{{ $post->reactions_count }} reactions</span>
                        <span>{{ $post->comments_count }} comments</span>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-4 border-t border-white/20">
                        <div class="flex space-x-2">
                            @if($post->status === 'approved')
                                <a href="{{ route('posts.show', $post) }}" class="glass-button text-sm">
                                    View
                                </a>
                            @endif
                            <a href="{{ route('posts.edit', $post) }}" class="glass-button text-sm">
                                Edit
                            </a>
                        </div>
                        <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-white/60 hover:text-red-400 transition-colors"
                                    onclick="return confirm('Are you sure you want to delete this post?')">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd"/>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 012 0v4a1 1 0 11-2 0V7zM12 7a1 1 0 112 0v4a1 1 0 11-2 0V7z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="glass-card max-w-md mx-auto">
                    <h3 class="text-2xl font-semibold text-white mb-2">No posts yet</h3>
                    <p class="text-white/70 mb-4">Start sharing your stories with the community!</p>
                    <a href="{{ route('posts.create') }}" class="glass-button">
                        Create Your First Post
                    </a>
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