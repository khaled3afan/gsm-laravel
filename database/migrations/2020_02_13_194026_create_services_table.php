<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description');
            $table->text('content');
            $table->integer('category_id');
            $table->integer('servicetype_id');
            $table->float('price', 8, 3);
            $table->float('real_price', 8, 3)->nullable();
            $table->string('info_label')->nullable()->default('insert info below');
            $table->string('info_placeholder')->nullable()->default('');
            $table->boolean('accept_info')->default(true);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
