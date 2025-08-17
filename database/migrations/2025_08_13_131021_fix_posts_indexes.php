<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixPostsIndexes extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Ensure we have proper indexes for sorting
            $table->index(['status', 'views_count', 'reactions_count', 'created_at'], 'posts_trending_index');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('posts_trending_index');
        });
    }
}
