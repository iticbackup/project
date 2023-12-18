<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratOfficeBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_office_berkas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('surat_office_id')->unsigned();
            // $table->uuid('user_id');
            $table->uuid('departemen_id');
            $table->string('files');
            $table->string('remaks')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('surat_office_berkas');
    }
}
