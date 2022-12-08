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
        // https://api.openweathermap.org/data/2.5/weather?lat=24.453884&lon=54.377342&appid=4c7f1f68689243332f5672f3f5d973e0&units=metric

        Schema::create('weather_history', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('coordinates');
            $table->string('weather_condition');
            $table->float('temperature', 8, 2);
            $table->float('feels_like', 8, 2);
            $table->integer('humidity');
            $table->float('speed', 8, 2);
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
        Schema::dropIfExists('weather_history');
    }
};
