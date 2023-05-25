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
        Schema::create('fabric_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fabric_type_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('fabric_type_id')->references('id')->on('fabric_types')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fabric_variants');
    }
};
