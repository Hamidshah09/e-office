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
        Schema::create('letters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('letter_no');
            $table->date('letter_date');
            $table->string('subject');
            $table->string('dispatch_no');
            $table->date('dispatch_date');
            $table->integer('sender_id');
            $table->integer('addressee_id');
            $table->integer('c_id')->comment('Correspondince id')->nullable();
            $table->string('remarks')->nullable();
            $table->string('scan_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
