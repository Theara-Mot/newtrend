<?php
namespace App\Observers;

use App\Models\Reaction;

class ReactionObserver
{
    public function created(Reaction $reaction)
    {
        // Update post reaction count
        $reaction->post->increment('reactions_count');
    }

    public function deleted(Reaction $reaction)
    {
        // Update post reaction count
        $reaction->post->decrement('reactions_count');
    }
}
