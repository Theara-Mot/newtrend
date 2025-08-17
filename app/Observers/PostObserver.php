<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    public function creating(Post $post)
    {
        // Set default counts
        $post->views_count = 0;
        $post->reactions_count = 0;
        $post->comments_count = 0;
    }

    public function created(Post $post)
    {
        // Update counts after creation
        $post->updateCounts();
    }

    public function updated(Post $post)
    {
        // Handle status changes for notifications
        if ($post->wasChanged('status')) {
            // This is handled in the admin controller
        }
    }
}