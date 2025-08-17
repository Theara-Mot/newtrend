<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('post_views', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('post_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
        //     $table->string('session_id')->nullable();
        //     $table->ipAddress('ip_address');
        //     $table->timestamp('viewed_at');
            
        //     $table->unique(['post_id', 'user_id']);
        //     $table->unique(['post_id', 'session_id']);
        // });
        Schema::create('post_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('session_id')->nullable();
            $table->ipAddress('ip_address');
            $table->timestamp('viewed_at');
            
            // Fix unique constraints - only one per post per user OR session
            $table->index(['post_id', 'user_id']);
            $table->index(['post_id', 'session_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_views');
    }
};
