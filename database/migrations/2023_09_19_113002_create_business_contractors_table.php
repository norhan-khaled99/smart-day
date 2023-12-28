<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessContractorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_contractors', function (Blueprint $table) {
            $table->id();
            $table->string("company_name")->nullable();
            $table->string("manager_name")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->nullable();
            $table->string("speciality")->nullable();
            $table->foreignId("area_id")->nullable()->constrained("areas");
            $table->foreignId("city_id")->nullable()->constrained("cities");
            $table->string("commercial_register")->nullable();
            $table->string("tax_register")->nullable();
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
        Schema::dropIfExists('business_contractors');
    }
}
