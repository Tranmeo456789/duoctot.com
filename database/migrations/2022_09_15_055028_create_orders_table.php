<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code_order',200);
            $table->unsignedBigInteger('customer_id')->nullable($value = true);
            $table->foreign('customer_id') -> references('id') ->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('total');
            $table->unsignedBigInteger('qty');
            $table->string('name',200);
            $table->string('phone',100);
            $table->string('address',200);
            $table->string('address_detail',200);
            $table->string('delivery_form',200);
            $table->string('request_invoice',200);
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
