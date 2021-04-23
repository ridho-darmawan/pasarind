<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKatalogWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_katalog_wisata', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('katalog_wisata_uuid');
            $table->integer('harga');
            $table->integer('jumlah_orang');
            $table->integer('diskon');
            $table->string('jumlah_hari');
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
        Schema::dropIfExists('detail_katalog_wisata');
    }
}
