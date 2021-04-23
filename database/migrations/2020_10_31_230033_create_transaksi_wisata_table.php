<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_wisata', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('user_uuid');
            $table->uuid('katalog_wisata_uuid');
            $table->integer('total_bayar');
            $table->datetime('waktu_keberangkatan');
            $table->datetime('waktu_transaksi')->nullable();
            $table->string('atas_nama');
            $table->string('kode_transaksi');
            $table->longText('bukti_pembayaran')->nullable();
            $table->enum('status',['Belum Bayar','Sedang Diverifikasi','Sudah Bayar'])->default('Belum Bayar');
            $table->string('no_hp');
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
        Schema::dropIfExists('transaksi_wisata');
    }
}
