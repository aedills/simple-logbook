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
        Schema::create('data_aktifitas', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('uuid_user', 255);
            $table->date('tanggal');
            $table->string('judul', 255);
            $table->text('keterangan');
            $table->string('foto')->default('default.png');
            $table->boolean('is_verified');
            $table->string('verified_by_uuid', 255)->default('0');
            $table->enum('status', ['ditolak', 'diterima'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_aktifitas');
    }
};
