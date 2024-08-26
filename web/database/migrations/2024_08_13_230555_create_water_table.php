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
        Schema::create('water', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('days', 100);
            $table->date('date');
            $table->time('time');
            $table->double('level', 15, 8);;
            $table->string('action', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water');
    }
};
