<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiBusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_bus', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('katalog_bus_uuid');
            $table->uuid('user_uuid')->nullable();
            $table->string('atas_nama')->nullable();
            $table->longText('alamat_penjemputan')->nullable();
            $table->date('tanggal_booking');
            $table->integer('total_bayar');
            $table->longText('bukti_pembayaran');
            $table->string('kode_transaksi');
            $table->enum('status',['Belum Bayar','Sedang Diverifikasi','Sudah Bayar'])->default('Belum Bayar');
            $table->datetime('waktu_transaksi')->nullable();
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
        Schema::dropIfExists('transaksi_bus');
    }
}
