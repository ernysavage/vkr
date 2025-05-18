<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserQuestsTable extends Migration
{
    public function up()
    {
        Schema::create('user_quests', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->uuid('user_id');
    $table->uuid('quest_id');
    $table->boolean('is_completed')->default(false);
    $table->integer('current_value')->default(0);
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('quest_id')->references('id')->on('quests')->onDelete('cascade');
});
    }

    public function down()
    {
        Schema::dropIfExists('user_quests');
    }
}
