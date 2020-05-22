<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCiudadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ciudades', function (Blueprint $table) {
            $table->bigIncrements("geonameid");
            $table->string('name', 200);
            $table->string('ansiname', 200);
            $table->string('alternatenames', 2000);
            $table->double('latitude',8,2);
            $table->double('longitude',8,2);
            $table->char('feature_class', 1);
            $table->string('feature_code', 10);
            $table->char('country_code', 1);
            $table->string('cc2', 60);
            $table->string('admin1_code', 20);
            $table->string('admin2_code', 80);
            $table->string('admin3_code', 20);
            $table->string('admin4_code', 20);
            $table->bigInteger('population');
            $table->integer('elevation');
            $table->integer('gtopo30');
            $table->string('timezone', 40);
            $table->date('modification_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ciudades');
    }
}
