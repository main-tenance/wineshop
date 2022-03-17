<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferVineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_vine', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('offer_id');
            $table->foreign('offer_id')
                ->references('id')
                ->on('offers')
                ->onDelete('cascade');
            $table->unsignedBigInteger('vine_id');
            $table->foreign('vine_id')
                ->references('id')
                ->on('vines')
                ->onDelete('cascade');
            $table->tinyInteger('position')->nullable();
            $table->tinyInteger('percent')->nullable();
            $table->unique(['offer_id', 'vine_id']);
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
        Schema::dropIfExists('offer_vine');
    }
}
