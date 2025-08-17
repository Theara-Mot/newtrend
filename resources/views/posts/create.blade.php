@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="glass-card">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-white mb-2">Create New Post</h1>
            <p class="text-white/70">Share your story with the community</p>
        </div>

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label class="block text-white font-medium mb-2">Title *</label>
                <input type="text" 
                       name="title" 
                       value="{{ old('title') }}"
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
                          required>{{ old('body') }}</textarea>
                @error('body')
                    <p class="mt-1 text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Images -->
            <div>
                <label class="block text-white font-medium mb-2">Images (Optional)</label>
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
                            <p class="text-white/80">Click to select images or drag and drop</p>
                            <p class="text-white/60 text-sm">PNG, JPG, GIF up to 2MB each (max 5 images)</p>
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
                <a href="{{ route('home') }}" class="text-white/80 hover:text-white transition-colors">
                    Cancel
                </a>
                <div class="space-x-4">
                    <button type="submit" class="glass-button bg-blue-500/20 border-blue-400/30">
                        Submit for Review
                    </button>
                </div>
            </div>

            <div class="glass rounded-xl p-4 bg-yellow-500/10 border-yellow-400/30">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-yellow-100 font-medium">Review Process</p>
                        <p class="text-yellow-100/80 text-sm">Your post will be reviewed by our moderation team before going live. You'll be notified once it's approved.</p>
                    </div>
                </div>
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

// Drag and drop functionality
const dropZone = document.querySelector('label[for="images"]').parentElement;

dropZone.addEventListener('dragover', function(e) {
    e.preventDefault();
    dropZone.classList.add('border-white/50');
});

dropZone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    dropZone.classList.remove('border-white/50');
});

dropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    dropZone.classList.remove('border-white/50');
    
    const files = e.dataTransfer.files;
    document.getElementById('images').files = files;
    handleFileSelect({ target: { files: files } });
});
</script>
@endsection