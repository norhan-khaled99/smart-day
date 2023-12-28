<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name_ar")->nullable();
            $table->string("name_en")->nullable();
            $table->text("short_description")->nullable();
            $table->text("description")->nullable();
            $table->foreignId("black_media_manager_id")->nullable()->constrained("media_managers");
            $table->foreignId("white_media_manager_id")->nullable()->constrained("media_managers");
            $table->foreignId("base_category_id")->nullable()->constrained("base_categories");
            $table->string("url")->nullable();
            $table->boolean("with_photo")->default(1);
            $table->json("filter_setting")->nullable();
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
        Schema::dropIfExists('products');
    }
}
