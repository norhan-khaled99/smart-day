<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installs', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("serial")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->nullable();
            $table->string("order_number")->nullable();
            $table->integer("quantity")->nullable();
            $table->dateTime("date")->nullable();
            $table->foreignId('product_id')->nullable()->constrained('products');
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
        Schema::dropIfExists('installs');
    }
}
