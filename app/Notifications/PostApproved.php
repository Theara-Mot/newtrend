<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostApproved extends Notification
{
    use Queueable;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        // return ['mail', 'database'];
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your post has been approved!')
            ->greeting('Great news!')
            ->line('Your post "' . $this->post->title . '" has been approved and is now live.')
            ->action('View Post', route('posts.show', $this->post))
            ->line('Thank you for contributing to our community!');
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'post_approved',
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'message' => 'Your post "' . $this->post->title . '" has been approved!',
        ];
    }
}