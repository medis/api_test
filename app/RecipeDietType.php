<?php

namespace App;

class RecipeDietType extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];
    
    public function recipe() {
        $this->belongsTo(Recipe::class);
    }

}