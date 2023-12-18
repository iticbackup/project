<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormHydrantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_hydrant', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('inventaris_k3_detail_id');
            $table->string('kode_hydrant',100);
            $table->string('lokasi',100);
            $table->string('periode',100);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('form_hydrant_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('form_hydrant_id');
            $table->string('bulan',100)->nullable();
            $table->date('tanggal')->nullable();
            $table->text('selang')->nullable();
            $table->text('kran')->nullable();
            $table->text('nozzel')->nullable();
            $table->uuid('checker')->nullable();
            $table->text('keterangan')->nullable();
            $table->uuid('approval')->nullable();
            $table->string('status',2)->nullable();
            $table->string('images')->nullable();
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
        Schema::dropIfExists('form_hydrant');
        Schema::dropIfExists('form_hydrant_detail');
    }
}
