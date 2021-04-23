<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailMobilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_mobil', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('katalog_mobil_uuid');
            $table->string('tahun_pembuatan');
            $table->string('transmisi');
            $table->integer('jumlah_cc');
            $table->integer('jumlah_kursi');
            $table->string('warna');
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
        Schema::dropIfExists('detail_mobil');
    }
}
