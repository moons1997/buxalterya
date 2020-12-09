<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        date_default_timezone_set('Asia/Tashkent');
        Schema::create('pays', function (Blueprint $table) {
            $table->id();
            $table->boolean('type');
            $table->float('money');
            $table->text('comment')->default('');
            $table->integer('category_id');
            $table->string('date');
            $table->string('time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pays');
    }
}
