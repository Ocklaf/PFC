<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apiary;
use App\Models\User;
use App\Models\Place;

class ApiaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = Place::all();

        foreach ($places as $place) {
            $apiary = new Apiary();
            $apiary->user()->associate(1);
            $apiary->place()->associate($place);
            $apiary->beehives_quantity = 0;
            $apiary->save();
        }
    }
}
