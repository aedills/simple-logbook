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
        Schema::create('data_admin', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('nama', 255);
            $table->string('username', 25)->unique();
            $table->string('p4ssw0rd', 255);
            $table->string('foto', 255)->default('default.png');
            $table->enum('role', ['admin', 'ka.upt']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_admin');
    }
};
