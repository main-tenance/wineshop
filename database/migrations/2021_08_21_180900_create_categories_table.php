<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->foreign('code')
                ->references('code')
                ->on('codes')
                ->onDelete('restrict');
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('gender_id')->default(1);
            $table->foreign('gender_id')
                ->references('id')
                ->on('genders')
                ->onDelete('restrict');
            $table->timestamps(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
