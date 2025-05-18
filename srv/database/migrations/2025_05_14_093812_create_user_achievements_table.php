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
        Schema::create('user_achievements', function (Blueprint $table) {
    $table->uuid('user_id');
    $table->uuid('achievement_id');
    $table->timestamp('unlocked_at')->nullable();

    $table->primary(['user_id', 'achievement_id']);
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('achievement_id')->references('id')->on('achievements')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_achievements');
    }
};
