<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_pesanan');
            $table->string('no_meja');
            $table->integer('jumlah');
            $table->integer('total_bayar');
            $table->integer('id_makanan')->unsigned();
            $table->timestamps();

            $table->foreign('id_makanan')->references('id')->on('makanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
