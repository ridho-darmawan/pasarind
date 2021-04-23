<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusTransaksiMobilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_transaksi_mobil', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('transaksi_mobil_uuid');
            $table->datetime('waktu_transaksi');
            $table->enum('status',['Menunggu Pembayaran','Tunggu Konfirmasi Admin','Lunas','Pengambilan Kunci','Pengembalian Kunci','Batal'])->default('Menunggu Pembayaran');
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
        Schema::dropIfExists('status_transaksi_mobil');
    }
}
