<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiMobilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_mobil', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('user_uuid')->nullable();
            $table->uuid('katalog_mobil_uuid');
            $table->uuid('supir_uuid')->nullable();
            $table->date('start');
            $table->date('end');
            $table->longText('alamat_penjemputan')->nullable();
            $table->string('total_bayar');
            $table->longText('bukti_pembayaran')->nullable();
            $table->longText('foto_ktp');
            $table->string('no_hp');
            //$table->string('email')->nullable();
            $table->string('atas_nama');
            // $table->enum('status',['Belum Bayar','Sedang Diverifikasi','Sudah Bayar'])->default('Belum Bayar');
            $table->datetime('waktu_transaksi')->nullable();
            $table->string('kode_transaksi');
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
        Schema::dropIfExists('transaksi_mobil');
    }
}
