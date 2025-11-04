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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('kelas')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

         Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('nik')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

            Schema::create('kelassiswa', function (Blueprint $table) {
                $table->id();
                $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
                $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
                $table->timestamps();
                $table->softDeletes();
            });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas_and_siswa');
    }
};
