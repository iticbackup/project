<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisItPerangkatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris_it_perangkat', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_barcode');
            $table->string('lokasi');
            $table->uuid('departemen_id');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('inventaris_it_perangkat_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('inventaris_it_perangkat');
            $table->string('jenis_asset');
            $table->string('kode_asset');
            $table->string('status',2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventaris_it_perangkat');
        Schema::dropIfExists('inventaris_it_perangkat_detail');
    }
}
