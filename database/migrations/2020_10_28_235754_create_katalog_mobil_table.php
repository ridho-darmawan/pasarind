<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKatalogMobilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('katalog_mobil', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->longText('gambar');
            $table->string('nama_mobil');
            $table->uuid('merk_mobil_uuid');
            $table->uuid('jenis_mobil_uuid');
            $table->string('harga');
            $table->integer('diskon')->default(0);
            $table->longText('deskripsi');
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
        Schema::dropIfExists('katalog_mobil');
    }
}
