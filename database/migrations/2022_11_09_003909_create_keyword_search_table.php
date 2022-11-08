<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
class CreateKeywordSearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keyword_search', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('keyword',500)->nullable($value = true);
            $table->unsignedBigInteger('number_search')->nullable($value = true);
            $table->unsignedBigInteger('created_by')->nullable($value = true);
            $table->unsignedBigInteger('update_by')->nullable($value = true);
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
