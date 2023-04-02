<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Queen;
use Faker\Factory as Faker;

class QueenTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     */
    public function run(): void {


        function getYear($color) {

            switch ($color) {
                case 'Verde':
                    $year = date('Y') - 4;
                    break;
                case 'Azul':
                    $year = date('Y') - 3;
                    break;
                case 'Blanco':
                    $year = date('Y') - 2;
                    break;
                case 'Amarillo':
                    $year = date('Y') - 1;
                    break;
                case 'Rojo':
                    $year = date('Y');
                    break;
            }

            return $year;
        }

        $faker = Faker::create();

        for ($i = 0; $i < 110; $i++) { //ponía 600
            $queen = new Queen();
            $queen->user_id = 1;
            $queen->race = $faker->randomElement(['Ibérica', 'Italiana', 'Europea', 'Cárnica', 'Africana']);
            $queen->color = $faker->randomElement(['Azul', 'Blanco', 'Amarillo', 'Rojo', 'Verde']);
            $queen->start_date = getYear($queen->color);
            $queen->end_date = $queen->start_date + 4; //Realidad es +5, pero por mostrar algunas con fecha de cambio
            $queen->is_inseminated = $faker->boolean;
            $queen->is_zanganera = $faker->boolean;
            $queen->is_new_blood = $faker->boolean;
            $queen->save();
        }
    }
}
