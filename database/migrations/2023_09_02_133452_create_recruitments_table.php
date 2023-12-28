<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitments', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("nationality")->nullable();
            $table->string("age")->nullable();
            $table->string("certificates")->nullable();
            $table->string("experience")->nullable();
            $table->string("area")->nullable();
            $table->string("city")->nullable();
            $table->string("phone")->nullable();
            $table->text("message")->nullable();
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
        Schema::dropIfExists('recruitments');
    }
}
