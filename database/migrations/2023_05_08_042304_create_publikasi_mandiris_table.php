<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublikasiMandirisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publikasi_mandiris', function (Blueprint $table) {
            $table->uuid('id_pubman');
            $table->string('judul_jurnal_pubman');
            $table->string('nm_jurnal_pubman');
            $table->string('vol_jurnal_pubman');
            $table->string('no_jurnal_pubman');
            $table->date('tgl_terbit_jurnal_pubman');
            $table->integer('jumlah_penulis_pubman');
            $table->string('dok_jurnal_pubman')->nullable();
            $table->string('link_jurnal_pubman');
            $table->string('status_jurnal_pubman');
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
        Schema::dropIfExists('publikasi_mandiris');
    }
}
