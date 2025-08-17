@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">Manage Posts</h1>
        <a href="{{ route('admin.dashboard') }}" class="glass-button">
            Back to Dashboard
        </a>
    </div>

    <!-- Filter -->
    <div class="glass-card">
        <form method="GET" class="flex items-center space-x-4">
            <select name="status" class="glass-input">
                <option value="">All Status</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            <button type="submit" class="glass-button">Filter</button>
        </form>
    </div>

    <!-- Posts List -->
    <div class="space-y-4">
        @forelse($posts as $post)
            <div class="glass-card">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <span class="status-badge 
                                @if($post->status === 'approved') bg-green-500/20 border-green-400/30 text-green-100
                                @elseif($post->status === 'pending') bg-yellow-500/20 border-yellow-400/30 text-yellow-100
                                @else bg-red-500/20 border-red-400/30 text-red-100
                                @endif">
                                {{ ucfirst($post->status) }}
                            </span>
                            <span class="text-white/60 text-sm">by {{ $post->user->name }}</span>
                            <span class="text-white/60 text-sm">{{ $post->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        
                        <h3 class="text-xl font-semibold text-white mb-2">{{ $post->title }}</h3>
                        <p class="text-white/70 mb-3">{{ Str::limit($post->body, 200) }}</p>
                        
                        <div class="flex items-center space-x-4 text-sm text-white/60">
                            <span>{{ $post->views_count }} views</span>
                            <span>{{ $post->reactions_count }} reactions</span>
                            <span>{{ $post->comments_count }} comments</span>
                        </div>
                    </div>

                    <div class="flex flex-col space-y-2 ml-4">
                        @if($post->status === 'approved')
                            <a href="{{ route('posts.show', $post) }}" class="glass-button text-sm">
                                View
                            </a>
                        @endif
                        
                        @if($post->status === 'pending')
                            <form method="POST" action="{{ route('admin.posts.approve', $post) }}" class="inline">
                                @csrf
                                <button type="submit" class="glass-button text-sm bg-green-500/20 w-full">
                                    Approve
                                </button>
                            </form>
                            
                            <button onclick="openRejectModal({{ $post->id }})" class="glass-button text-sm bg-red-500/20">
                                Reject
                            </button>
                        @endif
                        
                        <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="glass-button text-sm bg-red-500/20 w-full"
                                    onclick="return confirm('Delete this post permanently?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="glass-card text-center py-8">
                <p class="text-white/70">No posts found.</p>
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

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black/80 backdrop-blur-md hidden z-50 flex items-center justify-center p-4">
    <div class="glass-card max-w-md w-full">
        <h3 class="text-xl font-semibold text-white mb-4">Reject Post</h3>
        <form id="rejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-white font-medium mb-2">Rejection Reason</label>
                <textarea name="reason" 
                          rows="4" 
                          placeholder="Explain why this post is being rejected..."
                          class="glass-input w-full"
                          required></textarea>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeRejectModal()" class="text-white/80 hover:text-white">
                    Cancel
                </button>
                <button type="submit" class="glass-button bg-red-500/20">
                    Reject Post
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function openRejectModal(postId) {
    document.getElementById('rejectForm').action = `/admin/posts/${postId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('rejectModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRejectModal();
    }
});
</script>
@endsection