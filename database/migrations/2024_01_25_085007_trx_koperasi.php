<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('trx_koperasi', function (Blueprint $table) {
            $table->id();
            $table->string('npk', 5);
            $table->date('tgl_transaksi');
            $table->string('kode', 4);
            $table->integer('qty');
            $table->decimal('harga', 10, 2);
            $table->bigInteger('bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
