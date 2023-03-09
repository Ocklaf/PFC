<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Beehive;
use Faker\Factory as Faker;

class BeehiveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 600; $i++) {
            $honey = rand(1,10);

            if ($i <= 180) {
                $beehive = new Beehive();
                $beehive->user_id = 1;
                $beehive->apiary_id = 1;
                $beehive->queen_id = $i;
                $beehive->type = $faker->randomElement(['Langstroth', 'Dadant', 'Layens']);
                $beehive->honey_frames = 6;
                $beehive->pollen_frames = 2;
                $beehive->brood_frames = 2;
                $beehive->save();
                continue;
            }

            if($i >180 && $i <= 300) {
                $beehive = new Beehive();
                $beehive->user_id = 1;
                $beehive->apiary_id = 2;
                $beehive->queen_id = $i;
                $beehive->type = $faker->randomElement(['Langstroth', 'Dadant', 'Layens']);
                $beehive->honey_frames = 5;
                $beehive->pollen_frames = 4;
                $beehive->brood_frames = 1;
                $beehive->save();
                continue;
            }
            $beehive = new Beehive();
            $beehive->user_id = 2;
            $beehive->apiary_id = 3;
            $beehive->queen_id = $i;
            $beehive->type = $faker->randomElement(['Langstroth', 'Dadant', 'Layens']);
            $beehive->honey_frames = 5;
            $beehive->pollen_frames = 4;
            $beehive->brood_frames = 1;
            $beehive->save();

        }
    }
}
