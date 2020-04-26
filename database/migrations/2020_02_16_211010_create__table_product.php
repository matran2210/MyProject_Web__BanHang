<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProduct extends Migration
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
            $table->bigInteger('id_type'); //khóa ngoại id của bảng type_products
            $table->string('name');
            $table->bigInteger('unit_price'); //giá gốc
            $table->bigInteger('promotion_price'); //giá khuyến mãi

            $table->integer('new'); // thuộc tính kiểm tra xem sản phẩm mới hay cũ, ta để = 1 là còn mới, =0 là cũ rồi
            $table->string('image'); //chứa url ảnh avatar của sản phẩm
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
        Schema::dropIfExists('products');
    }
}
