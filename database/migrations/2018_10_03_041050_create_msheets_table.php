<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMsheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msheets', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('msection_id');
            $table->text('contents');
            $table->unsignedTinyInteger('order');
            $table->string('foreground', 6)->nullable();
            $table->string('background', 6)->nullable();
            $table->timestamps();

            $table->foreign('msection_id')
                  ->references('id')->on('msections')
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
        Schema::dropIfExists('msheets');
    }
}
