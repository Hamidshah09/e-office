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
        Schema::create('trackings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('letter_id');
            $table->integer('marked_to')->comment('its an officer id or section id depanding on next column value');
            $table->integer('send_by');
            $table->timestamp('sent_on');
            $table->integer('sent_to');
            $table->timestamp('received_on');
            $table->integer('tracking_status_id')->comment('tracing status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trackings');
    }
};
