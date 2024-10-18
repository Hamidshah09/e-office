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
        Schema::create('markings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('letter_id');
            $table->integer('marked_to')->comment('This refer to officer/addressee id');
            $table->integer('updated_by')->comment('refer to user');
            $table->timestamp('created_at');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markings');
    }
};
