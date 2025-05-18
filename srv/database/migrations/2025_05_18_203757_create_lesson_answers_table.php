<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('lesson_answers', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->foreignUuid('lesson_question_id')->constrained()->onDelete('cascade');
        $table->string('answer');
        $table->boolean('is_correct')->default(false);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_answers');
    }
};
