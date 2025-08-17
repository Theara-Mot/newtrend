<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="glass-card">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-white mb-2">Edit Post</h1>
            <p class="text-white/70">Update your story</p>
        </div>

        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Status Notice -->
            @if($post->status === 'rejected')
                <div class="glass rounded-xl p-4 bg-red-500/10 border-red-400/30">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-red-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-red-100 font-medium">Post was rejected</p>
                            <p class="text-red-100/80 text-sm">Please review and update your post before resubmitting.</p>
                        </div>
                    </div>
                </div>
            @elseif($post->status === 'pending')
                <div class="glass rounded-xl p-4 bg-yellow-500/10 border-yellow-400/30">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="text-yellow-100 font-medium">Post is under review</p>
                            <p class="text-yellow-100/80 text-sm">Your post is currently being reviewed by our moderation team.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Title -->
            <div>
                <label class="block text-white font-medium mb-2">Title *</label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title', $post->title) }}"
                       placeholder="Enter an engaging title..." 
                       class="glass-input w-full @error('title') border-red-400 @enderror"
                       required>
                @error('title')
                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div>
                <label class="block text-white font-medium mb-2">Content *</label>
                <textarea name="body" 
                          rows="8" 
                          placeholder="Tell your story..."
                          class="glass-input w-full resize-none @error('body') border-red-400 @enderror"
                          required>{{ old('body', $post->body) }}</textarea>
                @error('body')
                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current Images -->
            @if($post->image_urls)
                <div>
                    <label class="block text-white font-medium mb-2">Current Images</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                        @foreach($post->image_urls as $imageUrl)
                            <div class="relative">
                                <img src="{{ $imageUrl }}" alt="{{ $post->title }}" class="w-full h-32 object-cover rounded-xl glass">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- New Images -->
            <div>
                <label class="block text-white font-medium mb-2">Replace Images (Optional)</label>
                <div class="glass rounded-2xl p-6 border-2 border-dashed border-white/30 text-center">
                    <input type="file" 
                           id="images" 
                           name="images[]" 
                           multiple 
                           accept="image/*"
                           class="hidden"
                           onchange="handleFileSelect(event)">
                    <label for="images" class="cursor-pointer">
                        <div class="space-y-2">
                            <svg class="w-12 h-12 text-white/60 mx-auto" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-white/80">Click to select new images</p>
                            <p class="text-white/60 text-sm">This will replace all current images</p>
                        </div>
                    </label>
                </div>
                
                <!-- Image Preview -->
                <div id="imagePreview" class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4 hidden"></div>
                
                @error('images')
                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                @enderror
                @error('images.*')
                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-between pt-6 border-t border-white/20">
                <a href="{{ route('posts.my') }}" class="text-white/80 hover:text-white transition-colors">
                    Cancel
                </a>
                <button type="submit" class="glass-button bg-blue-500/20 border-blue-400/30">
                    Update Post
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function handleFileSelect(event) {
    const files = event.target.files;
    const preview = document.getElementById('imagePreview');
    
    if (files.length > 0) {
        preview.classList.remove('hidden');
        preview.innerHTML = '';
        
        for (let i = 0; i < Math.min(files.length, 5); i++) {
            const file = files[i];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-32 object-cover rounded-xl glass">
                    <div class="absolute top-2 right-2 glass rounded-full px-2 py-1 text-xs text-white">
                        ${file.name}
                    </div>
                `;
                preview.appendChild(div);
            };
            
            reader.readAsDataURL(file);
        }
    } else {
        preview.classList.add('hidden');
    }
}
</script>
@endsection
</body>
</html>