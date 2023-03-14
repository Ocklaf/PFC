<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $place = new Place();
        $place->user_id = 1;
        $place->name = 'La Chinela';
        $place->catastral_code = '172HXK0000AKFLP98291';
        $place->poligon = '17';
        $place->parcel = '570';
        $place->postal_code = '46164';
        $place->has_water = true;
        $place->save();

        $place = new Place();
        $place->user_id = 1;
        $place->name = 'El Secanet';
        $place->catastral_code = '987LLH0330ARZLR47581';
        $place->poligon = '98';
        $place->parcel = '765';
        $place->postal_code = '46018';
        $place->has_water = true;
        $place->save();

        $place = new Place();
        $place->user_id = 2;
        $place->name = 'Chucheve';
        $place->catastral_code = '123ABC0000JKAAS12347';
        $place->poligon = '12';
        $place->parcel = '345';
        $place->postal_code = '46001';
        $place->has_water = false;
        $place->save();


        //Lugares sin asignar un colmenar
        $place = new Place();
        $place->user_id = 1;
        $place->name = 'La pinada';
        $place->catastral_code = '123LGH0330ARZLR47581';
        $place->poligon = '98';
        $place->parcel = '765';
        $place->postal_code = '46018';
        $place->has_water = true;
        $place->save();

    }
}
