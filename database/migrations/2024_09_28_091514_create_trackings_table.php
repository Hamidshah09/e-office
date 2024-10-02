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
            $table->integer('marking_type_id')->comment('it refer to where letter market to it could be eaither section or officer');
            $table->integer('received_by');
            $table->integer('send_to');
            $table->integer('tracking_status_id')->comment('tracing status');
            $table->timestamps();
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
