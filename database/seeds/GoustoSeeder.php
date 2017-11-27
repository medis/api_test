<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use League\Csv\Reader;

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
    public function run()
    {
        $records = $this->reader->getRecords();
        foreach ($records as $offset => $record) {
            dd($record);
        }
    }
}
