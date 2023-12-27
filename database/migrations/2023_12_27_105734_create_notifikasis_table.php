<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi_pesan');
            $table->timestamp('tanggal_dikirim');
            $table->unsignedBigInteger('pemesanan_id');
            $table->foreign('pemesanan_id')->references('id')->on('pemesanans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifikasis');
    }
};
