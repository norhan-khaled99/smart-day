<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_services', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->nullable();
            $table->string("facility")->nullable();
            $table->string("branch_number")->nullable();
            $table->foreignId("area_id")->nullable()->constrained("areas");
            $table->foreignId("city_id")->nullable()->constrained("cities");
            $table->string("neighborhood")->nullable();
            $table->string("street")->nullable();
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
        Schema::dropIfExists('notification_services');
    }
}
