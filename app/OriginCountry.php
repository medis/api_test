<?php

namespace App;

class OriginCountry extends BaseModel
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

}