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
        Schema::create('t_sales', function (Blueprint $table) {
            $table->id();
            $table->string('kode',10);
            $table->dateTime('tgl');
            $table->unsignedBigInteger('cust_id');
            $table->decimal('subtotal');
            $table->decimal('diskon');
            $table->decimal('ongkir');
            $table->decimal('total_bayar');
            $table->timestamps();

            $table->foreign('cust_id')->references('id')->on('m_customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_sales');
    }
};
