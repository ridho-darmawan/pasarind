<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusKatalogMobilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_katalog_mobil', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('katalog_mobil_uuid');
            $table->enum('status',['booking','ready'])->default('ready');
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
        Schema::dropIfExists('status_katalog_mobil');
    }
}
