<?php

namespace App;

class Rating extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipe_id', 'ip', 'rating'
    ];

    public function recipe() {
        return $this->belongsTo(Recipe::class);
    }

}