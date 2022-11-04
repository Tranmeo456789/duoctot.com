<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
class CreatePrescripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescrips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('info_product',500)->nullable($value = true);
            $table->unsignedBigInteger('user_id')->nullable($value = true);
            $table->unsignedBigInteger('user_sell')->nullable($value = true);
            $table->string('buyer',500)->nullable($value = true);
            
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
        //
    }
}
