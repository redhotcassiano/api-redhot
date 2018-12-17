<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->unsignedInteger('consultorios_id');
            $table->dateTime('data_consulta')->nullable()->default(new DateTime());
            $table->time('hora_consulta')->nullable()->default(new DateTime());
            $table->boolean('active')->nullable()->default(true);
            $table->unsignedInteger('client_id');
            $table->unsignedInteger('doctor_id');
            $table->foreign('consultorios_id')->references('id')->on('consultorios')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('doctor_id')->references('id')->on('users');

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
        Schema::dropIfExists('consultas');
    }
}
