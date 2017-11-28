<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use League\Csv\Reader;

use App\Base;
use App\BoxType;
use App\EquipmentNeeded;
use App\OriginCountry;
use App\ProteinSource;
use App\RecipeCuisine;
use App\RecipeDietType;
use App\Season;
use App\Recipe;

class GoustoSeeder extends Seeder
{

    protected $reader;

    public function __construct() {
        $path = database_path() . '/recipe-data.csv';
        $this->reader = Reader::createFromPath($path, 'r');
        $this->reader->setHeaderOffset(0);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $records = $this->reader->getRecords();
        foreach ($records as $offset => $record) {
            $recipe = Recipe::make([
                'title' => $record['title'],
                'slug' => $record['slug'],
                'short_title' => $record['short_title'],
                'marketing_description' => $record['marketing_description'],
                'calories_kcal' => $record['calories_kcal'],
                'protein_grams' => $record['protein_grams'],
                'fat_grams' => $record['fat_grams'],
                'carbs_grams' => $record['carbs_grams'],
                'bulletpoint1' => $record['bulletpoint1'],
                'bulletpoint2' => $record['bulletpoint2'],
                'bulletpoint3' => $record['bulletpoint3'],
                'preparation_time_minutes' => $record['preparation_time_minutes'],
                'shelf_life_days' => $record['shelf_life_days'],
                'in_your_box' => $record['in_your_box'],
                'gousto_reference' => $record['gousto_reference']
            ]);
            $recipe->originCountry()->associate($this->getOrCreate(OriginCountry::class, ['title' => $record['origin_country']]));
            $recipe->boxType()->associate($this->getOrCreate(BoxType::class, ['title' => $record['box_type']]));
            $recipe->recipeDietType()->associate($this->getOrCreate(RecipeDietType::class, ['title' => $record['recipe_diet_type_id']]));
            $recipe->season()->associate($this->getOrCreate(Season::class, ['title' => $record['season']]));
            $recipe->base()->associate($this->getOrCreate(Base::class, ['title' => $record['base']]));
            $recipe->proteinSource()->associate($this->getOrCreate(ProteinSource::class, ['title' => $record['protein_source']]));
            $recipe->equipmentNeeded()->associate($this->getOrCreate(EquipmentNeeded::class, ['title' => $record['equipment_needed']]));
            $recipe->recipeCuisine()->associate($this->getOrCreate(RecipeCuisine::class, ['title' => $record['recipe_cuisine']]));
            $recipe->save();
        }
    }

    private function getOrCreate($_class, $attributes) {
        return $_class::firstOrCreate($attributes);
    }
}
