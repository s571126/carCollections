<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCars extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('maker_id');
            $table->unsignedBigInteger('cartype_id');
            $table->string('car_name');  //車名
            $table->integer('price');  //金額
            $table->integer('total_price');  //金額
            $table->unsignedBigInteger('carcolor_id');
            $table->integer('made_year');  //製造年（西暦）
            $table->integer('mileage');  //走行距離
            $table->integer('displacement');  //排気量
            $table->string('memo');  //備考
            $table->unsignedBigInteger('created_user_id');  //登録者
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('created_user_id')->references('id')->on('users');
            $table->foreign('maker_id')->references('id')->on('mst_makers');
            $table->foreign('cartype_id')->references('id')->on('mst_cartypes');        
            $table->foreign('carcolor_id')->references('id')->on('mst_carcolors');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_cars');
    }
}
