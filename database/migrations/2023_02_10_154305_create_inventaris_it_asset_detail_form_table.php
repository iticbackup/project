<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisItAssetDetailFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris_it_asset_detail_form', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('inventaris_it_perangkat_detail_id');
            $table->string('lokasi');
            $table->string('jenis_merk');
            $table->string('jenis_type');
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
        Schema::dropIfExists('inventaris_it_asset_detail_form');
    }
}
