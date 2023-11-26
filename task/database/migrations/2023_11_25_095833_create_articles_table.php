<?php

use App\Models\Article;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->longText('image');
            $table->string('title');
            $table->string('tags')->default("");
            $table->enum('type', [Article::TYPE_BLOG, ARTICLE::TYPE_NEWS]);
            $table->string('description', 1000);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
