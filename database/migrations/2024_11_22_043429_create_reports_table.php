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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('folder_id')->references('id')->on('folders')->constrained('folders')->cascadeOnUpdate()->cascadeOnDelete()->nullable();
            $table->string('user_id')->references('id')->on('users')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete()->nullable();
            $table->string('documentation')->nullable();
            $table->string('original_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('year')->nullable();
            $table->string('month')->nullable();
            $table->string('day')->nullable();
            $table->string('extension')->nullable();
            $table->string('size')->nullable();
            $table->timestamps();
            $table->index('folder_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
