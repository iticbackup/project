<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratOfficeVerifikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_office_verifikasi', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('surat_office_id')->unsigned();
            $table->integer('continuous');
            $table->integer('status');
            // $table->string('remaks')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('surat_office_id')->references('id')->on('surat_office')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surat_office_verifikasi');
    }
}
