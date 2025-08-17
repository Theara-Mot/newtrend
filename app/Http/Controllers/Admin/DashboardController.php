<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostApproved;
use App\Notifications\PostRejected;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $pendingPosts = Post::pending()->count();
        $totalPosts = Post::count();
        $totalUsers = User::where('role', 'user')->count();
        $bannedUsers = User::where('is_banned', true)->count();

        return view('admin.dashboard', compact(
            'pendingPosts',
            'totalPosts',
            'totalUsers',
            'bannedUsers'
        ));
    }

    public function posts(Request $request)
    {
        $query = Post::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $posts = $query->orderByDesc('created_at')->paginate(20);

        return view('admin.posts', compact('posts'));
    }

    public function approvePost(Post $post)
    {
        $post->update(['status' => 'approved']);
        $post->user->notify(new PostApproved($post));

        return redirect()->back()->with('success', 'Post approved successfully!');
    }

    public function rejectPost(Post $post, Request $request)
    {
        $request->validate([
            'reason' => 'required|string|max:500',
        ]);

        $post->update(['status' => 'rejected']);
        $post->user->notify(new PostRejected($post, $request->reason));

        return redirect()->back()->with('success', 'Post rejected successfully!');
    }

    public function users(Request $request)
    {
        $query = User::where('role', 'user');

        if ($request->filled('banned')) {
            $query->where('is_banned', $request->banned === '1');
        }

        $users = $query->orderByDesc('created_at')->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function banUser(User $user)
    {
        $user->update(['is_banned' => true]);
        return redirect()->back()->with('success', 'User banned successfully!');
    }

    public function unbanUser(User $user)
    {
        $user->update(['is_banned' => false]);
        return redirect()->back()->with('success', 'User unbanned successfully!');
    }
}