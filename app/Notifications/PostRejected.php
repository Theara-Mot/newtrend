<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostRejected extends Notification
{
    use Queueable;

    public $post;
    public $reason;

    public function __construct(Post $post, $reason)
    {
        $this->post = $post;
        $this->reason = $reason;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Post Review Update')
            ->greeting('Hello!')
            ->line('Your post "' . $this->post->title . '" has been reviewed.')
            ->line('Reason: ' . $this->reason)
            ->line('You can edit and resubmit your post for review.')
            ->action('Edit Post', route('posts.edit', $this->post))
            ->line('Thank you for your understanding.');
    }

    public function toArray($notifiable)
    {
        return [
            'type' => 'post_rejected',
            'post_id' => $this->post->id,
            'post_title' => $this->post->title,
            'reason' => $this->reason,
            'message' => 'Your post "' . $this->post->title . '" needs revision.',
        ];
    }
}