<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class RecipeMobileResource extends Resource
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
            'box_type' => optional($this->boxType)->title,
            'title' => $this->title,
            'short_title' => $this->short_title,
            'marketing_description' => $this->marketing_description,
            'calories_kcal' => $this->calories_kcal,
            'protein_grams' => $this->protein_grams,
            'fat_grams' => $this->fat_grams,
            'carbs_grams' => $this->carbs_grams,
            'bulletpoint1' => $this->bulletpoint1,
            'bulletpoint2' => $this->bulletpoint2,
            'bulletpoint3' => $this->bulletpoint3
        ];
    }
}