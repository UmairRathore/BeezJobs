<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcceptedOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accepted_offers', function (Blueprint $table) {
            $table->id();
            $table->integer('sender_id');
            $table->integer('reciever_id');
            $table->string('title');
            $table->date('date');
            $table->enum('time_of_day', ['morning', 'afternoon', 'evening', 'night']);
            $table->enum('online_or_in_person', ['online', 'in_person']);
            $table->string('location');
            $table->text('description');
            $table->float('budget');
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
        Schema::dropIfExists('accepted__offers');
    }
}
