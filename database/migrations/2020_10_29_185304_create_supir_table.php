<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supir', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('nama');
            $table->string('alamat');
            $table->longText('foto');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('status',['ready','booking'])->default('ready');
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
        Schema::dropIfExists('supir');
    }
}
