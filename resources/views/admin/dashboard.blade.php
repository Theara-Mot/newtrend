@extends('layouts.app')

@section('content')
<!-- Background elements -->
<div class="bg-elements">
    <div class="floating-orb orb-1"></div>
    <div class="floating-orb orb-2"></div>
    <div class="floating-orb orb-3"></div>
</div>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">Admin Dashboard</h1>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="glass-card stat-card">
            <div class="status-indicator status-pending"></div>
            <div class="stat-number">{{ $pendingPosts }}</div>
            <div class="stat-label">Pending Posts</div>
        </div>
        <div class="glass-card stat-card">
            <div class="status-indicator status-active"></div>
            <div class="stat-number">{{ $totalPosts }}</div>
            <div class="stat-label">Total Posts</div>
        </div>
        <div class="glass-card stat-card">
            <div class="status-indicator status-active"></div>
            <div class="stat-number">{{ $totalUsers }}</div>
            <div class="stat-label">Total Users</div>
        </div>
        <div class="glass-card stat-card">
            <div class="status-indicator status-warning"></div>
            <div class="stat-number">{{ $bannedUsers }}</div>
            <div class="stat-label">Banned Users</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="actions-grid">
        <div class="glass-card action-card">
            <h2 class="action-title">Content Management</h2>
            <div class="action-buttons">
                <a href="{{ route('admin.posts', ['status' => 'pending']) }}" class="glass-button primary">
                    Review Pending Posts
                    <span class="count">{{ $pendingPosts }}</span>
                </a>
                <a href="{{ route('admin.posts') }}" class="glass-button">
                    Manage All Posts
                </a>
                <a href="#" class="glass-button">
                    Content Analytics
                </a>
            </div>
        </div>

        <div class="glass-card action-card">
            <h2 class="action-title">User Management</h2>
            <div class="action-buttons">
                <a href="{{ route('admin.users') }}" class="glass-button">
                    Manage Users
                </a>
                <a href="{{ route('admin.users', ['banned' => '1']) }}" class="glass-button">
                    View Banned Users
                    <span class="count">{{ $bannedUsers }}</span>
                </a>
                <a href="#" class="glass-button">
                    User Analytics
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Add interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.glass-card');
        
        // Add click ripple effect
        cards.forEach(card => {
            card.addEventListener('click', function(e) {
                const ripple = document.createElement('div');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.3);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    left: ${x}px;
                    top: ${y}px;
                    width: ${size}px;
                    height: ${size}px;
                    pointer-events: none;
                `;
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add counter animation
        const counters = document.querySelectorAll('.stat-number');
        const observerOptions = {
            threshold: 0.7
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.textContent.replace(/,/g, ''));
                    let count = 0;
                    const increment = target / 60;
                    
                    const timer = setInterval(() => {
                        count += increment;
                        if (count >= target) {
                            counter.textContent = target.toLocaleString();
                            clearInterval(timer);
                        } else {
                            counter.textContent = Math.floor(count).toLocaleString();
                        }
                    }, 16);
                }
            });
        }, observerOptions);

        counters.forEach(counter => {
            observer.observe(counter);
        });
    });
</script>

<style>
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
</style>
@endsectionq