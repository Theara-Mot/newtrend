<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'type',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getTypes()
    {
        return ['like', 'love', 'haha', 'sad', 'angry'];
    }

    public static function getEmoji($type)
    {
        return [
            'like' => '👍',
            'love' => '❤️',
            'haha' => '😂',
            'sad' => '😢',
            'angry' => '😡',
        ][$type] ?? '👍';
    }
}