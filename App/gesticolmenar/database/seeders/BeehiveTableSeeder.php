<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Beehive;
use Faker\Factory as Faker;

class BeehiveTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $totalOfBeehives = 600;
        $beehivesApiaryOne = 180;
        $beehivesApiaryTwo = 120;

        function frames($beehive) {
            $totalFrames = 10;

            $beehive->honey_frames = rand(3, 6);
            $totalFrames = $totalFrames - $beehive->honey_frames;

            if ($totalFrames % 2 !== 0) {
                $beehive->pollen_frames = $totalFrames / 2 - 1;
                $beehive->brood_frames = $totalFrames / 2;
                return;
            }

            $beehive->pollen_frames = $totalFrames / 2;
            $beehive->brood_frames = $totalFrames / 2;
        }

        for ($i = 1; $i <= $totalOfBeehives; $i++) {

            if ($i <= $beehivesApiaryOne) {
                $beehive = new Beehive();
                $beehive->user_id = 1;
                $beehive->apiary_id = 1;
                $beehive->queen_id = $i;
                $beehive->type = 'Langstroth';
                frames($beehive);
                $beehive->save();
                continue;
            }

            if ($i > $beehivesApiaryOne && $i <= $beehivesApiaryOne + $beehivesApiaryTwo) {
                $beehive = new Beehive();
                $beehive->user_id = 1;
                $beehive->apiary_id = 2;
                $beehive->queen_id = $i;
                $beehive->type =  'Dadant';
                frames($beehive);
                $beehive->save();
                continue;
            }

            $beehive = new Beehive();
            $beehive->user_id = 2;
            $beehive->apiary_id = 3;
            $beehive->queen_id = $i;
            $beehive->type = 'Layens';
            frames($beehive);
            $beehive->save();
        }
    }
}
