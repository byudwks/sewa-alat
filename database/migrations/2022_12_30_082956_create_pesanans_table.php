<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('post_id');
            $table->unsignedBigInteger('post_id');
            $table->foreign('post_id')->references('id')->on('posts');
            // $table->foreignId('user_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('token');
            $table->string('nama_acara');
            $table->string('image')->nullable();
            $table->string('status_pesan');
            $table->string('alamat_acara');
            $table->string('no_hp');
            $table->string('jumlah_hari');
            $table->string('jumlah_barang');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_pulang');
            $table->date('tanggal_kembali')->nullable();
            $table->string('jumlah_harga');
            $table->string('hilang_rusak')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('pesanans');
    }
};
