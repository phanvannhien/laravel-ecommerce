<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('blogs'))
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');

            $table->text('blog_title');
            $table->longText('blog_content')->nullable();
            $table->text('blog_excerpt')->nullable();
            $table->string('blog_thumbnail', 255)->nullable();
            $table->string('blog_status', 50)->defaultsTo('publish');
            $table->string('blog_type', 50)->defaultsTo('post');
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
        Schema::dropIfExists('blogs');
    }
}
