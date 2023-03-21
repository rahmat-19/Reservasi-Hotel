<?php

use App\Models\PaketWisata;
use App\Models\Pelanggan;
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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pelanggan::class);
            $table->foreignIdFor(PaketWisata::class);
            $table->dateTime('tgl_reservasi_wisata');
            $table->decimal('diskon');
            $table->float('nilai_diskon');
            $table->integer('harga');
            $table->integer('jumlah_peserta');
            $table->integer('total_bayar');
            $table->string('bukti_tf');
            $table->enum('status_reservasi_wisata', ['pesan', 'dibayar', 'selesai']);
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
        Schema::dropIfExists('reservasis');
    }
};
