<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users'))
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('full_name',150)->nullable();
                $table->string('gender',50)->nullable();
                $table->timestamp( 'dob' )->nullable();
                $table->string('phone',13);
                $table->boolean('status')->defaultsTo(1);
                $table->boolean('locked')->defaultsTo(0);
                $table->string('email',150)->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password',200)->nullable();
                $table->rememberToken();
                $table->timestamps();

                // relations
                $table->integer('group_id')->unsigned();

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
