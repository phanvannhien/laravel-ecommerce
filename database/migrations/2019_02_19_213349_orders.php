<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->boolean('is_guest')->nullable();
            $table->string('email')->nullable();
            $table->string('full_name')->nullable();
            $table->string('shipping_method')->nullable();
            $table->string('shipping_title')->nullable();
            $table->string('shipping_description')->nullable();
            $table->integer('total_item_count')->nullable();
            $table->integer('total_item_ordered')->nullable();
            $table->string('base_currency_code')->nullable();
            $table->integer('total')->unsigned()->defaultsTo(0);
            $table->integer('discount_percent')->unsigned()->defaultsTo(0);
            $table->integer('discount_amount')->unsigned()->defaultsTo(0);
            $table->string('status',50)->defaultsTo('waiting');
            $table->text('note')->nullable();

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
