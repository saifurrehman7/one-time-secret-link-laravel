<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('secret_links', function (Blueprint $table) {
            $table->id();
            $table->text('secret_text');
            $table->string('slug')->unique();
            $table->dateTime('expires_at');
            $table->dateTime('viewed_at')->nullable();
            $table->boolean('is_burned')->default(false);
            $table->boolean('first_url')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secret_links');
    }
};
