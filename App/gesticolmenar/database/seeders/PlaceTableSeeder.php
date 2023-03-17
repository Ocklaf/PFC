<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        /*Usuario 1*/
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
        $place->name = 'El escalón de la Nina';
        $place->catastral_code = 'A88HXK07031984J98133';
        $place->poligon = '632';
        $place->parcel = '5';
        $place->postal_code = '46234';
        $place->has_water = true;
        $place->save();

        $place = new Place();
        $place->user_id = 1;
        $place->name = 'Ca Galindo';
        $place->catastral_code = '987LLH0330ARZLR47581';
        $place->poligon = '98';
        $place->parcel = '765';
        $place->postal_code = '46418';
        $place->has_water = true;
        $place->save();

        $place = new Place();
        $place->user_id = 1;
        $place->name = 'Los 7 pisos';
        $place->catastral_code = '666LLH0330ARZLR47581';
        $place->poligon = '124';
        $place->parcel = '7';
        $place->postal_code = '46024';
        $place->has_water = false;
        $place->save();

        $place = new Place();
        $place->user_id = 1;
        $place->name = 'Los Chopos';
        $place->catastral_code = '750KZR4AA0SSQW77AA81';
        $place->poligon = '1245';
        $place->parcel = '478';
        $place->postal_code = '46187';
        $place->has_water = false;
        $place->save();

        //Lugares sin asignar un colmenar usuario 1
        $place = new Place();
        $place->user_id = 1;
        $place->name = 'La Pinada';
        $place->catastral_code = '123LGH0330ARZLR47581';
        $place->poligon = '98';
        $place->parcel = '765';
        $place->postal_code = '46085';
        $place->has_water = true;
        $place->save();

        // $place = new Place();
        // $place->user_id = 1;
        // $place->name = 'La Poceta';
        // $place->catastral_code = 'RSAA4H0330ARÑP747324';
        // $place->poligon = '98';
        // $place->parcel = '765';
        // $place->postal_code = '46018';
        // $place->has_water = true;
        // $place->save();

        // $place = new Place();
        // $place->user_id = 1;
        // $place->name = 'Caseta rallada';
        // $place->catastral_code = '123ABC0000JKAAS12347';
        // $place->poligon = '12';
        // $place->parcel = '345';
        // $place->postal_code = '46001';
        // $place->has_water = false;
        // $place->save();
    }
}
