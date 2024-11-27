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
        Schema::table('users', function (Blueprint $table) {
            $table->longText('nip')->after('role_id')->nullable();
            $table->string('rank')->after('nip')->nullable();
            $table->string('group')->after('rank')->nullable();
            $table->string('position')->after('group')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['nip','pangkat','golongan','jabatan']);
        });
    }
};
