<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_images', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->longText('image');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_images');
    }
};
