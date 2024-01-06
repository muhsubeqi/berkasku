<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_kategori_id')->constrained('sub_kategori')->onUpdate('cascade')->onDelete('cascade');
            $table->string('sub_sub_kategori')->nullable();
            $table->string('nama');
            $table->text('keterangan')->nullable();
            $table->string('uploader')->nullable();
            $table->string('file')->nullable();
            $table->string('path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen');
    }
}