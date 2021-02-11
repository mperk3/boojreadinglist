<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 250);
            $table->text('subtitle');
            $table->string('authors');
            $table->string('isbn13',13)->unique();
            $table->string('image_url',256);
            $table->tinyInteger('position')->unsigned();
            $table->timestamps();
            $table->index('isbn13');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
