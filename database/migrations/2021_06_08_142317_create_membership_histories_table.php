<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_histories', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_payment');
            $table->dateTime('ending_period');
            $table->string('subscription_type');
            $table->string('period_type');
            $table->string('payment_method');
            $table->integer('respond_quota');
            $table->string('status');
            $table->integer('amount');
            $table->foreignId('company_id');
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
        Schema::dropIfExists('membership_histories');
    }
}
