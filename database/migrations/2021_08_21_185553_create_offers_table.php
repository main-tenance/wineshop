<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('active')->default(0);
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('wine_id');
            $table->foreign('wine_id')
                ->references('id')
                ->on('wines')
                ->onDelete('cascade');
            $table->unsignedBigInteger('sugar_id')->nullable();
            $table->foreign('sugar_id')
                ->references('id')
                ->on('sugars')
                ->onDelete('cascade');
            $table->unsignedFloat('spirt', 3, 1);
            $table->unsignedFloat('volume', 5, 3);
            $table->unsignedSmallInteger('year')->nullable();
            $table->unsignedFloat('price', 8, 2);
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
        Schema::dropIfExists('offers');
    }
}
