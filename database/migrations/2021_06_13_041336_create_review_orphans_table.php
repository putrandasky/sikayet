<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewOrphansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_orphans', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->tinyInteger('rating');
            $table->string('title');
            $table->string('accept_tnc');
            $table->string('photo');
            $table->text('description');
            $table->foreignId('review_type_id');
            $table->foreignId('user_id');
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
        Schema::dropIfExists('review_orphans');
    }
}
