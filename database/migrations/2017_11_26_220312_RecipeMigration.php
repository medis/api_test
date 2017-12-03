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
            $table->string('short_title')->nullable();
            $table->longText('marketing_description')->nullable();
            $table->unsignedSmallInteger('calories_kcal')->nullable();
            $table->unsignedSmallInteger('protein_grams')->nullable();
            $table->unsignedSmallInteger('fat_grams')->nullable();
            $table->unsignedSmallInteger('carbs_grams')->nullable();
            $table->string('bulletpoint1')->nullable();
            $table->string('bulletpoint2')->nullable();
            $table->string('bulletpoint3')->nullable();
            $table->unsignedInteger('recipe_diet_type_id')->index()->nullable();
            $table->unsignedInteger('season_id')->index()->nullable();
            $table->unsignedInteger('base_id')->index()->nullable();
            $table->unsignedInteger('protein_source_id')->index()->nullable();
            $table->unsignedSmallInteger('preparation_time_minutes')->nullable();
            $table->unsignedSmallInteger('shelf_life_days')->nullable();
            $table->unsignedInteger('equipment_needed_id')->index()->nullable();
            $table->unsignedInteger('origin_country_id')->index()->nullable();
            $table->unsignedInteger('recipe_cuisine_id')->index()->nullable();
            $table->longText('in_your_box')->nullable();
            $table->unsignedInteger('gousto_reference')->nullable();
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
