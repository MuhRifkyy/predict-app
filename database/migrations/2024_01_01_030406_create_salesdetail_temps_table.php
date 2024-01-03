<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesdetail_temps', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table-> unsignedBigInteger('id_produk');
            $table->foreign('id_produk')->references('id')->on('product');
            $table->integer('jumlah_produk');
            $table->date('bulan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salesdetail_temps');
    }
};
