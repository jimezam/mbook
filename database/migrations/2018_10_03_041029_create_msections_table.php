<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('mbook_id');
            $table->string('name', 100);
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('order');
            $table->timestamps();

            $table->foreign('mbook_id')
                  ->references('id')->on('mbooks')
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
        Schema::dropIfExists('msections');
    }
}
