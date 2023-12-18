<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portal', function (Blueprint $table) {
            $table->id();
            $table->string('title',150);
            $table->string('link');
            $table->string('images');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('portal_departemen', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('portal_id')->unsigned();
            $table->uuid('departemen_id');
            $table->string('color');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('portal_id')->references('id')->on('portal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portal');
        Schema::dropIfExists('portal_departemen');
    }
}
