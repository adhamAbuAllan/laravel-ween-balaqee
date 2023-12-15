<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
//            $table->string('about_the_user')->default("");
//            $table->string('major',55)->default("");
//            $table->string('email')->default("")->unique();
            /*
             * be careful !!!
             * don't delete those two lines those tables of database
             * -------------------------------------------------
             * //$table->integer('university_id')->default(1);
             * $table->integer('type_id',)->default(1);
1             */
            $table->integer('type_id')->default(6);//6 is guest user that mean is no account have
//            $table->string('profile')->default('images/profile/user.png');
            $table->string('password');
            $table->integer('country_phone_number_id',)->default(2);
            $table->integer('active')->default(1);
//            $table->string('random_password');
            $table->rememberToken();
            $table->timestamps();
//            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
