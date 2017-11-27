<?php

namespace App;

class EquipmentNeeded extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title'
    ];

    protected $table = 'equipment_needed';

    public function recipe() {
        $this->belongsTo(Recipe::class);
    }

}