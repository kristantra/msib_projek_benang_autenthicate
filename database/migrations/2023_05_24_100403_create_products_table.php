<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fabric_variant_id');
            $table->string('color');
            $table->string('color_code');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('fabric_variant_id')->references('id')->on('fabric_variants')->onDelete('cascade');
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
};
