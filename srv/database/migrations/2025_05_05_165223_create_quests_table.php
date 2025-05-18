<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestsTable extends Migration
{
    public function up()
    {
        Schema::create('quests', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->string('title');
    $table->text('description')->nullable();
    $table->integer('target_value'); // например, накопить 1000₽
    $table->string('type'); // например, "income", "expense", "lesson"
    $table->timestamps();
});

    }

    public function down()
    {
        Schema::dropIfExists('quests');
    }
}
