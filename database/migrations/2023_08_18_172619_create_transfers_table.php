<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('buyer_id');
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('order_id');
            $table->decimal('amount', 10, 2);
            //not_cleared and cleared are for clearance of amount after order
            $table->enum('status', ['un_cleared', 'cleared'])->default('un_cleared');
            $table->timestamps();

            $table->foreign('buyer_id')->references('id')->on('users');
            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfers');
    }
}
