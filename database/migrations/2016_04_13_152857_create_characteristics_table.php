<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharacteristicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristics', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer("person_id")->unsigned();
            $table->foreign("person_id")->references("id")->on("people");
            $table->integer("simple_id")->unsigned();
            $table->integer("composite_id")->unsigned();
            $table->char("value_type", 255);
            $table->string("string");
            $table->datetime("timestamp");
            $table->integer("number");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('characteristics');
    }
}
