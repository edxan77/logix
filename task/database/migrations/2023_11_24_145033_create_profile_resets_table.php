<?php

use App\Models\ProfileReset;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profile_resets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('email');
            $table->string('token')->nullable();
            $table->string('code', 4)->nullable();
            $table->enum('type', [ProfileReset::RESET_TYPE_PASSWORD, ProfileReset::RESET_TYPE_EMAIL]);
            $table->enum('status',[ProfileReset::TOKEN_STATUS_EXPIRED, ProfileReset::TOKEN_STATUS_VALID]);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profile_resets');
    }
};
