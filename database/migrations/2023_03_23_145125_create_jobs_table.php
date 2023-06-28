<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->date('date');
            $table->enum('time_of_day', ['morning', 'afternoon', 'evening', 'night']);
            $table->enum('online_or_in_person', ['online', 'in_person']);
            $table->string('location');
            $table->text('description');
            $table->float('budget');
            $table->string('status');
            $table->decimal('hourly_rate', 8, 2)->nullable();
            $table->decimal('basic_price', 8, 2)->nullable();
            $table->text('basic_description')->nullable();
            $table->decimal('standard_price', 8, 2)->nullable();
            $table->text('standard_description')->nullable();
            $table->decimal('premium_price', 8, 2)->nullable();
            $table->text('premium_description')->nullable();
            $table->string('job_type')->nullable(); // Added column 'job_type' as nullable
            $table->unsignedBigInteger('offer_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
