<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormApartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_apart', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('inventaris_k3_detail_id');
            $table->string('kode_tabung',100);
            $table->string('jenis',100);
            $table->string('warna',100);
            $table->string('berat',100);
            $table->date('expired');
            $table->string('tempat');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('form_apart_detail', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('form_apart_id');
            $table->string('bulan',100)->nullable();
            $table->string('tanggal',100)->nullable();
            $table->string('pressure',20)->nullable();
            $table->string('nozzel',20)->nullable();
            $table->string('segel',20)->nullable();
            $table->string('tuas',20)->nullable();
            $table->uuid('ttd')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('status',2)->nullable();
            $table->string('images')->nullable();
            $table->uuid('approval')->nullable();
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
        Schema::dropIfExists('form_apart');
    }
}
