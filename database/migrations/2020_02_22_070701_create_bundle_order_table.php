<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBundleOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('bundle_id');
            $table->unsignedBigInteger('order_id');
            $table->foreign('bundle_id')->references('id')->on('bundles');
            $table->foreign('order_id')->references('id')->on('orders');
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
        Schema::dropIfExists('bundle_order');
    }
}
