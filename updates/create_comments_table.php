<?php

namespace JeroenvanRensen\Comments\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('jeroenvanrensen_comments_comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedBigInteger('jeroenvanrensen_blog_post_id');
            $table->string('user_name', 255);
            $table->string('user_email', 255);
            $table->text('body');
            $table->boolean('approved');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jeroenvanrensen_comments_comments');
    }
}
