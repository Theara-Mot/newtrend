<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->isBanned()) {
                return redirect()->route('home')->with('error', 'Your account has been banned.');
            }
            return $next($request);
        });
    }

    public function toggle(Request $request, Post $post)
    {
        if ($post->status !== 'approved') {
            abort(404);
        }

        $request->validate([
            'type' => 'required|in:' . implode(',', Reaction::getTypes()),
        ]);

        $userId = auth()->id();
        $type = $request->type;

        $existingReaction = $post->reactions()->where('user_id', $userId)->first();

        if ($existingReaction) {
            if ($existingReaction->type === $type) {
                // Remove reaction
                $existingReaction->delete();
                $post->decrement('reactions_count');
                $reacted = false;
                $currentType = null;
            } else {
                // Update reaction type (no count change needed)
                $existingReaction->update(['type' => $type]);
                $reacted = true;
                $currentType = $type;
            }
        } else {
            // Create new reaction
            $post->reactions()->create([
                'user_id' => $userId,
                'type' => $type,
            ]);
            $post->increment('reactions_count');
            $reacted = true;
            $currentType = $type;
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'reacted' => $reacted,
                'current_type' => $currentType,
                'reactions_count' => $post->fresh()->reactions_count,
                'reaction_counts' => $post->getReactionCounts(),
            ]);
        }

        return redirect()->back();
    }
}