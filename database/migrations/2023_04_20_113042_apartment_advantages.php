<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ApartmentAdvantages extends Migration
{
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartment_advantages', function (Blueprint $table) {
            $table->id();
            $table->integer('apartment_id');
            $table->integer('advantage_id');
            $table->timestamps();



            $table->foreign('apartment_id')->references('id')->on('apartments')->onDelete('cascade');
            $table->foreign('advantage_id')->references('id')->on('advantages')->onDelete('cascade');
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
