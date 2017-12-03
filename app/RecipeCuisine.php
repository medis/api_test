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

    /**
     * Change qualified name from id to title.
     * This allows to use ->find(<title>),
     * which means we can use SEO-friendly paths.
     *
     * @return string
     */
    public function getQualifiedKeyName()
    {
        return $this->getTable().'.title';
    }

}