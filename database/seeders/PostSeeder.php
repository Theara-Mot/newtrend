<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Reaction;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('role', 'user')->get();
        
        foreach ($users as $user) {
            // Create 2-5 posts per user
            $postCount = rand(2, 5);
            
            for ($i = 0; $i < $postCount; $i++) {
                $post = Post::create([
                    'user_id' => $user->id,
                    'title' => $this->getRandomTitle(),
                    'body' => $this->getRandomBody(),
                    'status' => $this->getRandomStatus(),
                    'views_count' => rand(0, 1000),
                    'reactions_count' => rand(0, 100),
                    'comments_count' => rand(0, 50),
                ]);

                // Add random comments
                if ($post->status === 'approved') {
                    $commentCount = rand(0, 10);
                    for ($j = 0; $j < $commentCount; $j++) {
                        Comment::create([
                            'post_id' => $post->id,
                            'user_id' => $users->random()->id,
                            'content' => $this->getRandomComment(),
                        ]);
                    }

                    // Add random reactions
                    $reactionCount = rand(0, 20);
                    $reactionUsers = $users->random($reactionCount);
                    foreach ($reactionUsers as $reactionUser) {
                        Reaction::create([
                            'post_id' => $post->id,
                            'user_id' => $reactionUser->id,
                            'type' => ['like', 'love', 'haha', 'sad', 'angry'][array_rand(['like', 'love', 'haha', 'sad', 'angry'])],
                        ]);
                    }
                }
            }
        }
    }

    private function getRandomTitle()
    {
        $titles = [
            'My Amazing Travel Adventure',
            'Daily Life in the City',
            'Cooking My Favorite Recipe',
            'Weekend Photography Walk',
            'Learning Something New Today',
            'Behind the Scenes of My Project',
            'Exploring Local Culture',
            'My Morning Routine',
            'Creative Process Revealed',
            'Unexpected Discoveries',
            'Life Lessons Learned',
            'Seasonal Changes Around Me',
            'Technology That Changed Everything',
            'Family Time Chronicles',
            'Fitness Journey Update'
        ];

        return $titles[array_rand($titles)];
    }

    private function getRandomBody()
    {
        $bodies = [
            "Today was absolutely incredible! I wanted to share this amazing experience with all of you. The journey started early in the morning when I decided to step out of my comfort zone and try something completely different. What happened next was beyond my expectations and I learned so much about myself in the process. The people I met along the way were inspiring and reminded me why I love creating content for this community.",
            
            "I've been thinking about this topic for weeks, and finally decided to put my thoughts into words. Life has a funny way of teaching us lessons when we least expect it. Through all the ups and downs, I've realized that sharing our stories can make a real difference in someone's day. This particular experience taught me the value of patience and persistence.",
            
            "Behind every piece of content I create, there's a story worth telling. Today I'm pulling back the curtain to show you the real process, the struggles, and the victories that happen when the camera stops rolling. It's not always glamorous, but it's always authentic, and that's what matters most to me.",
            
            "Sometimes the most ordinary moments turn into extraordinary memories. What started as a simple walk turned into an adventure that reminded me why I fell in love with storytelling in the first place. The details might seem small, but they paint a picture of a life well-lived and experiences worth sharing.",
            
            "I wanted to take a moment to reflect on the journey so far and share some insights that might be helpful for others on similar paths. The road hasn't always been smooth, but every challenge has been a learning opportunity. Here's what I've discovered along the way and why it matters."
        ];

        return $bodies[array_rand($bodies)];
    }

    private function getRandomComment()
    {
        $comments = [
            "This is so inspiring! Thank you for sharing.",
            "Love this perspective! Can't wait to see more.",
            "Amazing content as always!",
            "This really resonated with me today.",
            "Your storytelling is incredible!",
            "Thanks for being so authentic and real.",
            "This made my day! Keep it up!",
            "Such great advice, definitely trying this!",
            "Your content always brightens my mood.",
            "Wow, this is exactly what I needed to hear!"
        ];

        return $comments[array_rand($comments)];
    }

    private function getRandomStatus()
    {
        $statuses = ['approved', 'approved', 'approved', 'pending', 'rejected'];
        return $statuses[array_rand($statuses)];
    }
}