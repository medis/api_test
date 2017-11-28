<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecipeMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('box_type_id')->index()->nullable();
            $table->string('title')->unique();
            $table->string('slug');
            $table->string('short_title');
            $table->longText('marketing_description');
            $table->unsignedSmallInteger('calories_kcal');
            $table->unsignedSmallInteger('protein_grams');
            $table->unsignedSmallInteger('fat_grams');
            $table->unsignedSmallInteger('carbs_grams');
            $table->string('bulletpoint1');
            $table->string('bulletpoint2');
            $table->string('bulletpoint3');
            $table->unsignedInteger('recipe_diet_type_id')->index()->nullable();
            $table->unsignedInteger('season_id')->index()->nullable();
            $table->unsignedInteger('base_id')->index()->nullable();
            $table->unsignedInteger('protein_source_id')->index()->nullable();
            $table->unsignedSmallInteger('preparation_time_minutes');
            $table->unsignedSmallInteger('shelf_life_days');
            $table->unsignedInteger('equipment_needed_id')->index()->nullable();
            $table->unsignedInteger('origin_country_id')->index()->nullable();
            $table->unsignedInteger('recipe_cuisine_id')->index()->nullable();
            $table->longText('in_your_box');
            $table->unsignedInteger('gousto_reference');
            $table->boolean('enabled')->default(TRUE);
            $table->timestamps();

            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recipes');
    }
}
