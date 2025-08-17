<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index1(Request $request)
    {
        $query = Post::approved()
            ->with(['user', 'comments.user', 'reactions'])
            ->withCount([
                'reactions',
                'comments'
                // REMOVED 'views' - this was causing the conflict
            ]);

        // Search filter
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('body', 'like', '%' . $request->search . '%');
            });
        }

        $sort = $request->get('sort', 'trending');

        switch ($sort) {
            case 'recent':
                $query->orderBy('posts.created_at', 'desc');
                break;

            case 'popular':
                // Use the physical column with table prefix
                $query->orderBy('posts.views_count', 'desc');
                break;

            case 'trending':
            default:
                // Use the physical column with table prefix
                $query->orderBy('posts.views_count', 'desc')
                      ->orderBy('reactions_count', 'desc')  // This comes from withCount
                      ->orderBy('posts.created_at', 'desc');
                break;
        }

        $posts = $query->paginate(12);

        return view('home', compact('posts'));
    }
    public function index(Request $request)
{
    $posts = Post::where('status', 'approved')
        ->with(['user'])
        ->orderBy('id', 'desc')
        ->paginate(12);

    return view('home', compact('posts'));
}

    public function show(Post $post, Request $request)
    {
        if ($post->status !== 'approved') {
            abort(404);
        }

        // Record view
        $this->recordView($post, $request);

        $post->load(['user', 'comments.user', 'reactions']);

        return view('posts.show', compact('post'));
    }

    private function recordView(Post $post, Request $request)
    {
        $userId = auth()->id();
        $sessionId = $request->session()->getId();
        $ipAddress = $request->ip();

        // Check if view already exists
        $existingView = $post->views()
            ->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        if (!$existingView) {
            $post->views()->create([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'ip_address' => $ipAddress,
                'viewed_at' => now(),
            ]);

            // Increment the physical column
            $post->increment('views_count');
        }
    }
}