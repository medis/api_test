<?php

namespace App;

class RecipeCuisine extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    public function recipes() {
        return $this->hasMany(Recipe::class);
    }

    public function getQualifiedKeyName()
    {
        return $this->getTable().'.title';
    }

}