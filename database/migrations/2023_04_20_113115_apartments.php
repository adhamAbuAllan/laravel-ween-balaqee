<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Apartments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
//    protected $hidden = ['created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];

    public function up()
    {

        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
//            $table->integer('is_booking')->default(1);
            $table->integer('rooms');
            $table->integer('bathrooms');
            $table->integer('city_id');
            $table->integer('type_id');
            $table->integer('square_meters');
            $table->string('title',55);
            $table->string('description',512);
            $table->integer('owner_id')->default(1);
            $table->string('location',70);
            $table->integer('count_of_student');
//            $table->string('phone',12);
//            $table->string('images')->nullable();
            $table->double('price');
//            $table->string('first_image');

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
    }

}
