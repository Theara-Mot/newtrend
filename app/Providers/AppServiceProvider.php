<?php
namespace App\Providers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Reaction;
use App\Observers\PostObserver;
use App\Observers\CommentObserver;
use App\Observers\ReactionObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Register observers
        Post::observe(PostObserver::class);
        Comment::observe(CommentObserver::class);
        Reaction::observe(ReactionObserver::class);
        
        // Use Bootstrap 5 for pagination
        Paginator::useBootstrapFive();
    }
}