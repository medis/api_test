<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class RecipeResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'box_type' => $this->boxType->title,
            'title' => $this->title,
            'slug' => $this->slug,
            'short_title' => $this->short_title,
            'marketing_description' => $this->marketing_description,
            'calories_kcal' => $this->calories_kcal,
            'protein_grams' => $this->protein_grams,
            'fat_grams' => $this->fat_grams,
            'carbs_grams' => $this->carbs_grams,
            'bulletpoint1' => $this->bulletpoint1,
            'bulletpoint2' => $this->bulletpoint2,
            'bulletpoint3' => $this->bulletpoint3,
            'recipe_diet_type_id' => $this->recipeDietType->title,
            'season' => $this->season->title,
            'base' => $this->base->title,
            'protein_source' => $this->proteinSource->title,
            'preparation_time_minutes' => $this->preparation_time_minutes,
            'shelf_life_days' => $this->shelf_life_days,
            'equipment_needed' => $this->equipmentNeeded->title,
            'origin_country' => $this->originCountry->title,
            'recipe_cuisine' => $this->recipeCuisine->title,
            'in_your_box' => $this->in_your_box,
            'gousto_reference' => $this->gousto_reference
        ];
    }
}