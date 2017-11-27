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
        $this->hasMany(Rating::class);
    }

    public function boxType() {
        $this->hasOne(BoxType::class);
    }

    public function recipeDietType() {
        $this->hasOne(RecipeDietType::class);
    }

    public function season() {
        $this->hasOne(Season::class);
    }

    public function base() {
        $this->hasOne(Base::class);
    }

    public function proteinSource() {
        $this->hasOne(ProteinSource::class);
    }

    public function equipmentNeeded() {
        $this->hasOne(EquipmentNeeded::class);
    }

    public function originCountry() {
        $this->hasOne(OriginCountry::class);
    }

    public function recipeCuisine() {
        $this->hasOne(RecipeCuisine::class);
    }
}