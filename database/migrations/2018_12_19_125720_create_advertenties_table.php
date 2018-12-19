<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertentiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertenties', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('created_at');
            $table->binary('image');       
            $table->string('titel');
            $table->longText('omschrijving');
            $table->foreign('naamVerkoper', 150)
            ->references('id')->on('users')
            ->onDelete('cascade');
            $table->decimal('vraagprijs',8,2);
            $table->foreign('category')
            ->references('name')->on('categories')
            ->onDelete('cascade');

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertenties');
    }
}
