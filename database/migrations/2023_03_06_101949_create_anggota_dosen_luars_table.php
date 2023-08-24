<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaDosenLuarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_dosen_luars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nidn_dosen_luar');
            $table->foreignId('id_proposal');
            $table->string('peran');
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
        Schema::dropIfExists('anggota_dosen_luars');
    }
}
