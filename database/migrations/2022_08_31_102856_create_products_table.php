<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',400);
            $table->string('type',200);
            $table->string('code',200);
            $table->string('cat',200);
            $table->unsignedBigInteger('producer_id');
            $table->foreign('producer_id') -> references('id_producer') ->on('producers')->onDelete('cascade');
            $table->unsignedBigInteger('size_id');
            $table->foreign('size_id') -> references('id') ->on('sizes')->onDelete('cascade');
            $table->string('tick',100);
            $table->string('type_price',200);
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('price_vat');
            $table->unsignedBigInteger('coefficient');
            $table->string('type_vat',200);
            $table->string('packing',200);
            $table->string('unit',200);
            $table->string('local_buy',200);
            $table->unsignedBigInteger('amout_max');
            $table->unsignedBigInteger('inventory');
            $table->text('general_info');
            $table->text('point');
            $table->text('dosage');
            $table->text('contraindication');
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
