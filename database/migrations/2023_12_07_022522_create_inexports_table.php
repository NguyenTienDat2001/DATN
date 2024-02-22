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
        Schema::create('inexports', function (Blueprint $table) {
            $table->id();
            //0: import 1: export
            $table->enum('type', [0,1]);
            //0 pending  1 accept 2 deny
            $table->enum('status', [0,1,2]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inexports');
    }
};
