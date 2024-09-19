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
        Schema::create('letter', function (Blueprint $table) {
            $table->increments('id');
            $table->string('letter_no');
            $table->date('letter_date');
            $table->string('subject');
            $table->integer('sender_id');
            $table->integer('addressee_id');
            $table->integer('tracking_id')->comment('refer to user id or section_id');
            $table->integer('track_type_id');
            $table->integer('c_id')->comment('Correspondince id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter');
    }
};
