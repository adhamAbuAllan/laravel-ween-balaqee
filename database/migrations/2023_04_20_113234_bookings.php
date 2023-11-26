<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bookings extends Migration
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
            $table->integer('apartment_id');
            $table->integer('user_id');
            $table->integer('price');
            $table->date('from_date');
            $table->date('to_date');
            $table->integer('month_count');
            $table->integer('total_price');
            $table->string('is_booking');
            $table->date('current_date');
            $table->integer('active')->default(1);
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
        //
    }
}
