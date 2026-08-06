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
        Schema::create('game_prices', function (Blueprint $table) {
            $table->unsignedInteger('id_gamePrice')->autoIncrement();
            $table->decimal('price', 10, 2);
            $table->decimal('retailPrice', 10, 2);
            $table->unsignedInteger('id_game');
            $table->unsignedInteger('id_store');

            $table->unique(['id_game', 'id_store']);
            $table->foreign('id_game')->references('id_game')->on('games')->onUpdate('cascade');
            $table->foreign('id_store')->references('id_store')->on('stores')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_prices');
    }
};
