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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('source_id',50);
            $table->string('source_name',100);
            $table->string('author');
            $table->string('title')->nullable(false);
            $table->text('description')->nullable(true);
            $table->text('url')->nullable(true);
            $table->text('url_to_image')->nullable(true);
            $table->string('published_at');
            $table->text('content')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
