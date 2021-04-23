<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileWebTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_web', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('nomor_telpon');
            $table->string('alamat');
            $table->text('map')->nullable();
            $table->string('email');
            $table->string('limit_pembayaran');
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
        Schema::dropIfExists('profile_web');
    }
}
