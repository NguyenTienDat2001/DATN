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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('category');
            $table->integer('buy_price');
            $table->integer('sell_price');
            $table->string('author');
            // 1: 0-6tuoi 2: 6-15tuoi 3: 15-18 tuoi 4: >18 tuoi 
            $table->enum('age', [1, 2, 3, 4]);
            $table->integer('published_at');
            $table->string('publisher');
            $table->integer('count');
            $table->integer('totalsale');
            $table->string('img');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
