<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Base extends BaseModel
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