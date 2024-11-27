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
        Schema::create('group_pages', function (Blueprint $table) {
            $table->increments('gp_id');
            $table->string('group_id')->references('group_id')->on('groups')->constrained('groups')->cascadeOnUpdate()->cascadeOnDelete()->nullable();
            $table->string('page_id')->references('page_id')->on('pages')->constrained('pages')->cascadeOnUpdate()->cascadeOnDelete()->nullable();
            $table->string('access')->nullable();
            $table->timestamps();
            $table->index('group_id');
            $table->index('page_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_pages');
    }
};
