<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Apiary;
use App\Models\User;
use App\Models\Place;
use Faker\Factory as Faker;

class ApiaryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = Place::all();
        $faker = Faker::create();

        foreach ($places as $place) {

            $apiary = new Apiary();
            $apiary->user()->associate(1);
            $apiary->last_visit = date('Y-m-d');
            $apiary->next_visit = date('Y-m-d', strtotime($apiary->last_visit . ' + ' . rand(1, 28) . ' days'));
            $apiary->clear_apiary = rand(0, 1);
            $apiary->refill_water = rand(0, 1);
            $apiary->collect_honey = rand(0, 1);
            $apiary->collect_pollen = rand(0, 1);
            $apiary->collect_apitoxine = rand(0, 1);
            $apiary->food = rand(0, 1);
            $apiary->others = $faker->text(100);
            $apiary->place()->associate($place);
            $apiary->beehives_quantity = 0;
            $apiary->save();
        }
    }
}
