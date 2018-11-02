<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('category_id');
            $table->string('shortname', 13)->unique();
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->enum('state', ['private', 'published', 'inactive'])->default('private');
            $table->string('theme', 50)->default('default');
            $table->string('style', 50)->default('default');
            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('category_id')
                  ->references('id')->on('categories')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mbooks');
    }
}
