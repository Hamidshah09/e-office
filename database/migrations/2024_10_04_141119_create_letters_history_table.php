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
        Schema::create('letters_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('letter_id');
            $table->integer('user_id');
            $table->string('column_name');
            $table->string('from');
            $table->string('to');
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters_history');
    }
};
