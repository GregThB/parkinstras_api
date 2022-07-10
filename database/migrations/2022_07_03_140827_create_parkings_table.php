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
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('idsurfs')->unique();
            $table->foreignId('id_city')->nullable();
            $table->string('street');
            $table->string('lat');
            $table->string('long');
            $table->foreignId('id_owner')->nullable();
            $table->string('max_height');
            $table->boolean('wheelchair_access');
            $table->boolean('electric_car');
            $table->boolean('full_time');
            $table->text('schedules')->nullable();
            $table->text('prices')->nullable();
            $table->string('slug')->nullable();
            $table->timestamps();

            $table->foreign('id_city')->references('id')->on('cities')
            ->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('id_owner')->references('id')->on('owners')
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
        Schema::dropIfExists('parkings');
    }
};
