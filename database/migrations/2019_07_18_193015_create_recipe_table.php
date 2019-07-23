<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('recipe_name');
            $table->string('recipe_ingredients');
            $table->string('recipe_calories');
            $table->string('recipe_protein');
            $table->string('recipe_carbs');
            $table->string('recipe_fat');
            $table->string('recipe_category');
            $table->string('recipe_description');
            $table->string('recipe_image')->nullable();
            $table->integer('recipe_people');
            $table->integer('recipe_owner_id');
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
        Schema::dropIfExists('recipes');
    }
}
