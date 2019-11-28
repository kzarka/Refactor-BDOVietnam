<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->nullable();
            $table->string('slug', 100)->nullable();
            $table->text('content')->nullable();
            $table->text('excert')->nullable();
            $table->string('thumbnail', 200)->nullable();;
            $table->string('banner', 200)->nullable();;
            $table->tinyInteger('public')->default(0);
            $table->unsignedInteger('author_id')->nullable();
            $table->integer('view_count')->default(0);
            $table->unsignedInteger('approved')->default(0);
            $table->unsignedInteger('game_id')->nullable();
            $table->foreign('game_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade');
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
        Schema::dropIfExists('posts');
    }
}
