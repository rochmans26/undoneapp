<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenLuarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen_luars', function (Blueprint $table) {
            $table->id();
            $table->string('nidn_dosen_luar')->unique();
            $table->string('nm_dosen_luar');
            $table->string('telp_dosen_luar');
            $table->string('email_dosen_luar');
            $table->string('fakultas_dosen_luar');
            $table->string('prodi_dosen_luar');
            $table->string('universitas_dosen_luar');
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
        Schema::dropIfExists('dosen_luars');
    }
}
