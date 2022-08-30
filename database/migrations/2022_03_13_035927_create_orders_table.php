<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('id_order')->unique();
            $table->string('id_product');
            $table->string('id_buyer');
            $table->string('id_seller');
            $table->enum('status_order',['pending','rejected','confirmed']);
            $table->integer('total_order');
            $table->integer('price_order');
            $table->string('proof_payment')->default('Belum ada bukti pembayaran');
            $table->string('notes')->default('Tidak ada catatan');
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
        Schema::dropIfExists('orders');
    }
}
