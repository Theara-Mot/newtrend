<?php
namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    public function created(Comment $comment)
    {
        // Update post comment count
        $comment->post->increment('comments_count');
    }

    public function deleted(Comment $comment)
    {
        // Update post comment count
        $comment->post->decrement('comments_count');
    }
}