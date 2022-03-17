<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wines', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('active')->default(0);
            $table->string('name');
            $table->string('original')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('restrict');
            $table->unsignedBigInteger('creator_id');
            $table->foreign('creator_id')
                ->references('id')
                ->on('creators')
                ->onDelete('restrict');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('restrict');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')
                ->references('id')
                ->on('areas')
                ->onDelete('restrict');
            $table->unsignedBigInteger('color_id')->nullable();
            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
                ->onDelete('restrict');
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
        Schema::dropIfExists('wines');
    }
}
