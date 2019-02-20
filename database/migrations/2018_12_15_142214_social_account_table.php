<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SocialAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('social_accounts'))
            Schema::create('social_accounts', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned();
                $table->string('provider_user_id',50)->unique();
                $table->string('provider',50);
                $table->string('token', 254)->nullable();

                $table->timestamps();

                //
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('social_accounts', function (Blueprint $table) {
            //
        });
    }
}
