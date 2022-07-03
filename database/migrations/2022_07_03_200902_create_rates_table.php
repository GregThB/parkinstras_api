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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->integer('mark');
            $table->text('body');
            $table->foreignId('user_id')->nullable();
            $table->foreignId('parking_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
            ->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('parking_id')->references('id')->on('parkings')
            ->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rates');
    }
};
