<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class RecipeFrontendResource extends Resource
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
            'title' => $this->title,
            'short_title' => $this->short_title,
            'marketing_description' => $this->marketing_description
        ];
    }
}