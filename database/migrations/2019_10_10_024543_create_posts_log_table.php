<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->nullable();
            $table->string('slug', 100)->nullable();
            $table->text('content')->nullable();
            $table->text('excert')->nullable();
            $table->string('thumbnail', 200)->default('/images/thumbnail.jpg');
            $table->string('banner', 200)->default('/images/thumbnail.jpg');
            $table->tinyInteger('public')->default(0);
            $table->smallInteger('author_id')->nullable();
            $table->integer('view_count')->default(0);
            $table->unsignedInteger('game_id');
            $table->foreign('game_id')
                ->references('id')
                ->on('games')
                ->onDelete('cascade');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_logs');
    }
}
