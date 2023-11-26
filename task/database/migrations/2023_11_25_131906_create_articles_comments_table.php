<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('article_id')->unsigned();
            $table->integer('comment_id')->unsigned();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles_comments');
    }
};
