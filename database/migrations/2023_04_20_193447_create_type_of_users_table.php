<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeOfUsersTable extends Migration
{
    protected $hidden = ['created_at', 'updated_at'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_of_users', function (Blueprint $table) {
            $table->id();
            $table->string('name',10)->default('طالب');
            $table->integer('active')->default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('type_of_users');
    }
}
