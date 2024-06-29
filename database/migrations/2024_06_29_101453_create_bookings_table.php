<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('room_name')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('workspace_id')->nullable();
            $table->integer('conference_id')->nullable();
            $table->integer('no_of_chair')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->date('booking_date')->nullable();
            $table->integer('amount')->nullable();
            $table->string('state_of_booking')->nullable();
            $table->string('payment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
