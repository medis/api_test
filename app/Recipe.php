<?php

namespace App;

class Recipe extends BaseModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillabel = [
        'title', 'slug', 'short_title', 'marketing_description', 'calories_kcal',
        'protein_grams', 'fat_grams', 'carbs_grams', 'bulletpoint1',
        'bulletpoint2', 'bulletpoint3', 'preparation_time_minutes',
        'shelf_life_days', 'in_your_box', 'gousto_reference'
    ];

    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    public function boxType() {
        return $this->belongsTo(BoxType::class);
    }

    public function recipeDietType() {
        return $this->belongsTo(RecipeDietType::class);
    }

    public function season() {
        return $this->belongsTo(Season::class);
    }

    public function base() {
        return $this->belongsTo(Base::class);
    }

    public function proteinSource() {
        return $this->belongsTo(ProteinSource::class);
    }

    public function equipmentNeeded() {
        return $this->belongsTo(EquipmentNeeded::class);
    }

    public function originCountry() {
        return $this->belongsTo(OriginCountry::class);
    }

    public function recipeCuisine() {
        return $this->belongsTo(RecipeCuisine::class);
    }
}