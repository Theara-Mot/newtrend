<?php
namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class FixPostCounts extends Command
{
    protected $signature = 'posts:fix-counts';
    protected $description = 'Fix post view, reaction, and comment counts';

    public function handle()
    {
        $this->info('Fixing post counts...');
        
        $posts = Post::all();
        $bar = $this->output->createProgressBar($posts->count());
        
        foreach ($posts as $post) {
            $post->refreshCounts();
            $bar->advance();
        }
        
        $bar->finish();
        $this->info("\nPost counts fixed successfully!");
    }
}