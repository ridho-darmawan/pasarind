<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailKatalogBusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_katalog_bus', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('katalog_bus_uuid');
            $table->string('harga');
            $table->string('diskon');
            $table->string('minimal_hari');
            $table->integer('jumlah_seat');
            $table->longText('deskripsi');
            $table->mediumText('rute_perjalanan');
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
        Schema::dropIfExists('detail_katalog_bus');
    }
}
