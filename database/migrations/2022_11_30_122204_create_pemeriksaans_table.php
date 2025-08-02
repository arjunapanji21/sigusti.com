<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('nama_balita')->nullable();
            $table->string('tgl_lahir')->nullable();
            $table->string('usia_saat_pemeriksaan')->nullable();
            $table->string('gender')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('berat')->nullable();
            $table->string('panjang')->nullable();
            $table->string('kode_pertumbuhan')->nullable();
            $table->string('kode_rekomendasi')->nullable();
            $table->string('kode_tindakan_perkembangan')->nullable();
            $table->string('jadwal_pertumbuhan')->nullable();
            $table->string('jadwal_perkembangan')->nullable();
            $table->string('jawaban_array')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemeriksaans');
    }
}
