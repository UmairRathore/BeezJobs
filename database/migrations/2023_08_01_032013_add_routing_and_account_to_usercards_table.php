<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoutingAndAccountToUsercardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_cards', function (Blueprint $table) {
            $table->string('routing_number')->nullable()->after('cvv');
            $table->string('account_number')->nullable()->after('routing_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_cards', function (Blueprint $table) {
            //
            $table->string('routing_number')->nullable()->after('cvv');
            $table->string('account_number')->nullable()->after('routing_number');
        });
    }
}
