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
        Schema::create('subsecrpions', function (Blueprint $table) {
            $table->id();
            $table->string('documentary_photo');
            $table->string('payment_status');
            $table->string('start_date');
            $table->string('end_date');
            $table->integer('plan_id');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subsecrpions');
    }
};
