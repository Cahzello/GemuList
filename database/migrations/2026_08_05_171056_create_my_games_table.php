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
        Schema::create('my_games', function (Blueprint $table) {
            $table->unsignedInteger('id_myGame')->autoIncrement();
            $table->string('status', 10);   
            $table->tinyInteger('score');
            $table->string('review', 180);
            $table->date('added_date');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_game');

            $table->unique(['id_user', 'id_game']);
            $table->foreign('id_user')->references('id_user')->on('user')->onUpdate('cascade');
            $table->foreign('id_game')->references('id_game')->on('games')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_games');
    }
};
