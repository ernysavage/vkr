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
    Schema::create('lesson_sections', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->foreignUuid('lesson_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->text('content')->nullable();
        $table->integer('position')->default(0); // порядок разделов
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_sections');
    }
};
