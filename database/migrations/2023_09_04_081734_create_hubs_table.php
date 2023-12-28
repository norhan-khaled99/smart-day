<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hubs', function (Blueprint $table) {
            $table->id();
            $table->string("name_ar")->nullable();
            $table->string("name_en")->nullable();
            $table->boolean("ethernet")->default(1);
            $table->boolean("wifi")->default(1);
            $table->boolean("basic")->default(1);
            $table->boolean("with_photo")->default(1);
            $table->string("sim")->nullable();
            $table->integer("scenarios")->nullable();
            $table->integer("cameras")->nullable();
            $table->integer("users")->nullable();
            $table->text("description")->nullable();
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
        Schema::dropIfExists('hubs');
    }
}
