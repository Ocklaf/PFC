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
        $users = User::all();
        $places = Place::all();

        $apiary = new Apiary();
        $apiary->user()->associate($users[0]);
        $apiary->place()->associate($places[0]);
        $apiary->beehives_quantity = 180;
        $apiary->save();

        $apiary = new Apiary();
        $apiary->user()->associate($users[0]);
        $apiary->place()->associate($places[1]);
        $apiary->beehives_quantity = 120;
        $apiary->save();

        $apiary = new Apiary();
        $apiary->user()->associate($users[1]);
        $apiary->place()->associate($places[2]);
        $apiary->beehives_quantity = 300;
        $apiary->save();
    }
}
