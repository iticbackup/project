<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisK3Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris_k3', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_barcode');
            $table->string('lokasi');
            $table->uuid('departemen_id');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('inventaris_k3_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('inventaris_k3_id');
            $table->string('jenis_barang');
            $table->string('status',2);
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('inventaris_k3_id')->references('uuid')->on('inventaris_k3')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventaris_k3');
        Schema::dropIfExists('inventaris_k3_detail');
    }
}
