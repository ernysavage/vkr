<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLessonsTable extends Migration
{
   public function up()
{
    Schema::create('user_lessons', function (Blueprint $table) {
        $table->uuid('user_id');
        $table->uuid('lesson_id');
        $table->boolean('is_completed')->default(false);
        $table->timestamp('completed_at')->nullable();

        $table->primary(['user_id', 'lesson_id']);

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
    });
}


    public function down()
    {
        Schema::dropIfExists('user_lessons');
    }
}
