<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Users</title>
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-white">Manage Users</h1>
        <a href="{{ route('admin.dashboard') }}" class="glass-button">
            Back to Dashboard
        </a>
    </div>

    <!-- Filter -->
    <div class="glass-card">
        <form method="GET" class="flex items-center space-x-4">
            <select name="banned" class="glass-input">
                <option value="">All Users</option>
                <option value="0" {{ request('banned') === '0' ? 'selected' : '' }}>Active Users</option>
                <option value="1" {{ request('banned') === '1' ? 'selected' : '' }}>Banned Users</option>
            </select>
            <button type="submit" class="glass-button">Filter</button>
        </form>
    </div>

    <!-- Users List -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($users as $user)
            <div class="glass-card">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <div class="glass rounded-full p-3">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-white">{{ $user->name }}</h3>
                            <p class="text-white/60 text-sm">{{ $user->email }}</p>
                        </div>
                    </div>
                    
                    @if($user->is_banned)
                        <span class="status-badge bg-red-500/20 border-red-400/30 text-red-100">
                            Banned
                        </span>
                    @else
                        <span class="status-badge bg-green-500/20 border-green-400/30 text-green-100">
                            Active
                        </span>
                    @endif
                </div>

                <div class="space-y-2 text-sm text-white/70 mb-4">
                    <div class="flex justify-between">
                        <span>Joined:</span>
                        <span>{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Posts:</span>
                        <span>{{ $user->posts_count ?? $user->posts()->count() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Comments:</span>
                        <span>{{ $user->comments_count ?? $user->comments()->count() }}</span>
                    </div>
                </div>

                <div class="flex space-x-2">
                    @if($user->is_banned)
                        <form method="POST" action="{{ route('admin.users.unban', $user) }}" class="flex-1">
                            @csrf
                            <button type="submit" class="glass-button text-sm bg-green-500/20 w-full">
                                Unban User
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ route('admin.users.ban', $user) }}" class="flex-1">
                            @csrf
                            <button type="submit" 
                                    class="glass-button text-sm bg-red-500/20 w-full"
                                    onclick="return confirm('Are you sure you want to ban this user?')">
                                Ban User
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full glass-card text-center py-8">
                <p class="text-white/70">No users found.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="flex justify-center">
            <div class="glass-card">
                {{ $users->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
</body>
</html>