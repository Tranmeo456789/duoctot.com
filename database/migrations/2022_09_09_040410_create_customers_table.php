<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',200);
            $table->string('code_customer',200);
            $table->string('email',200);
            $table->string('phone',200);
            $table->string('gender',200);
            $table->string('password',200);
            $table->string('address_detail',200);
            $table->string('address',200);
            $table->string('sale_area',200);
            $table->string('tax_code',200);
            $table->string('legal_representative',200);
            $table->string('customer_group',200);
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
