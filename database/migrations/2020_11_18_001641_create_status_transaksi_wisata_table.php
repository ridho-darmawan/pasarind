<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusTransaksiWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_transaksi_wisata', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('transaksi_wisata_uuid');
            $table->datetime('waktu_transaksi');
            $table->enum('status',['Belum Bayar','Sedang Diverifikasi','Sudah Bayar'])->default('Belum Bayar');
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
        Schema::dropIfExists('status_transaksi_wisata');
    }
}
