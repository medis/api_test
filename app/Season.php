<?php

namespace App;

class Season extends BaseModel
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
        return $this->hasMany(Recipe::class);
    }

}