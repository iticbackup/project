<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisItAssetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris_it_asset', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_perangkat',100);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('inventaris_it_asset_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('inventaris_it_asset_id');
            $table->string('nama_label');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('inventaris_it_asset');
        Schema::dropIfExists('inventaris_it_asset_detail');
    }
}
