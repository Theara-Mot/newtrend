@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- Post Content -->
    <article class="glass-card">
        <div class="space-y-6">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="glass rounded-full p-3">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-white font-medium">{{ $post->user->name }}</h4>
                        <p class="text-white/60 text-sm">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                
                @auth
                    @if(auth()->id() === $post->user_id)
                        <div class="flex space-x-2">
                            <a href="{{ route('posts.edit', $post) }}" class="glass-button text-sm">
                                Edit
                            </a>
                            <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="glass-button text-sm bg-red-500/20" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Title -->
            <h1 class="text-3xl md:text-4xl font-bold text-white">
                {{ $post->title }}
            </h1>

            <!-- Images -->
            @if($post->image_urls)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($post->image_urls as $imageUrl)
                        <div class="overflow-hidden rounded-2xl">
                            <img src="{{ $imageUrl }}" 
                                 alt="{{ $post->title }}"
                                 class="w-full h-64 md:h-80 object-cover hover:scale-110 transition-transform duration-300 cursor-pointer"
                                 onclick="openImageModal('{{ $imageUrl }}')">
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Body -->
            <div class="prose prose-invert max-w-none">
                <p class="text-white/90 text-lg leading-relaxed whitespace-pre-line">{{ $post->body }}</p>
            </div>

            <!-- Stats & Reactions -->
            <div class="flex items-center justify-between pt-6 border-t border-white/20">
                <div class="flex items-center space-x-6 text-white/80">
                    <span class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $post->views_count }} views</span>
                    </span>
                    <span class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd"/>
                        </svg>
                        <span>{{ $post->comments_count }} comments</span>
                    </span>
                </div>

                @auth
                    <div class="flex items-center space-x-2" id="reactions-container">
                        @foreach(['like', 'love', 'haha', 'sad', 'angry'] as $reactionType)
                            <button class="reaction-button {{ $post->hasUserReacted(auth()->id(), $reactionType) ? 'bg-white/30' : '' }}"
                                    onclick="toggleReaction('{{ $post->id }}', '{{ $reactionType }}')"
                                    title="{{ ucfirst($reactionType) }}">
                                {{ App\Models\Reaction::getEmoji($reactionType) }}
                            </button>
                        @endforeach
                    </div>
                @endauth
            </div>
        </div>
    </article>

    <!-- Comments Section -->
    <div class="glass-card">
        <div class="space-y-6">
            <h3 class="text-2xl font-bold text-white">Comments</h3>

            @auth
                <!-- Comment Form -->
                <form method="POST" action="{{ route('comments.store', $post) }}" class="space-y-4">
                    @csrf
                    <textarea name="content" 
                              rows="3" 
                              placeholder="Write a comment..."
                              class="glass-input w-full resize-none"
                              required></textarea>
                    <button type="submit" class="glass-button">
                        Post Comment
                    </button>
                </form>
            @else
                <div class="glass rounded-2xl p-4 text-center">
                    <p class="text-white/80 mb-4">Please login to comment</p>
                    <a href="{{ route('login') }}" class="glass-button">
                        Login
                    </a>
                </div>
            @endauth

            <!-- Comments List -->
            <div class="space-y-4" id="comments-container">
                @forelse($post->comments as $comment)
                    <div class="glass rounded-2xl p-4">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-3 flex-1">
                                <div class="glass rounded-full p-2">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <span class="font-medium text-white">{{ $comment->user->name }}</span>
                                        <span class="text-white/60 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-white/90">{{ $comment->content }}</p>
                                </div>
                            </div>
                            
                            @auth
                                @if(auth()->id() === $comment->user_id || auth()->user()->isAdmin())
                                    <form method="POST" action="{{ route('comments.destroy', $comment) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white/60 hover:text-red-400 transition-colors" onclick="return confirm('Delete this comment?')">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <p class="text-white/60">No comments yet. Be the first to comment!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black/80 backdrop-blur-md hidden z-50 flex items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImageModal()" class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors">
            <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
        </button>
        <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-2xl">
    </div>
</div>

<script>
function openImageModal(src) {
    document.getElementById('modalImage').src = src;
    document.getElementById('imageModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function toggleReaction(postId, type) {
    fetch(`/posts/${postId}/reactions`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': window.Laravel.csrfToken
        },
        body: JSON.stringify({ type: type })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update reaction buttons
            const buttons = document.querySelectorAll('.reaction-button');
            buttons.forEach(button => {
                button.classList.remove('bg-white/30');
            });
            
            if (data.reacted) {
                event.target.closest('.reaction-button').classList.add('bg-white/30');
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

// Close modal when clicking outside
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
@endsection