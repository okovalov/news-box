<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 500);
            $table->string('subject', 255);
            $table->string('author', 255)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('url', 255)->nullable();
            $table->string('url_to_image', 255)->nullable();
            $table->string('content', 1000)->nullable();
            $table->dateTime('published_at')->nullable();
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
        Schema::dropIfExists('news');
    }
}
