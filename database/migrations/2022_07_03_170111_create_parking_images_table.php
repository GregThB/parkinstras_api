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
        Schema::create('parking_images', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->integer('order');
            $table->foreignId('parking_id')->nullable();
            $table->timestamps();
            
            $table->foreign('parking_id')->references('id')->on('parkings')
            ->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parking_images');
    }
};
