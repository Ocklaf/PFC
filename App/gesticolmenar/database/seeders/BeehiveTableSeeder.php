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
        $totalOfBeehives = 105;
        $beehivesApiaryOne = 20;
        $beehivesApiaryTwo = 10;
        $beehivesApiaryThree = 5;
        $beehivesApiaryFour = 15;
        $beehivesApiaryFive = 30;
        $beehivesApiarySix = 25;

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
                $beehive->user_code = '' . 1 . 1 . $i;
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
                $beehive->user_code = '' . 1 . 2 . $i;
                $beehive->type =  'Dadant';
                frames($beehive);
                $beehive->save();
                continue;
            }

            if($i > $beehivesApiaryOne + $beehivesApiaryTwo && $i <= $beehivesApiaryOne + $beehivesApiaryTwo + $beehivesApiaryThree) {
                $beehive = new Beehive();
                $beehive->user_id = 1;
                $beehive->apiary_id = 3;
                $beehive->queen_id = $i;
                $beehive->user_code = '' . 1 . 3 . $i;
                $beehive->type = 'Layens';
                frames($beehive);
                $beehive->save();
                continue;
            }

            if($i > $beehivesApiaryOne + $beehivesApiaryTwo + $beehivesApiaryThree && $i <= $beehivesApiaryOne + $beehivesApiaryTwo + $beehivesApiaryThree + $beehivesApiaryFour) {
                $beehive = new Beehive();
                $beehive->user_id = 1;
                $beehive->apiary_id = 4;
                $beehive->queen_id = $i;
                $beehive->user_code = '' . 1 . 4 . $i;
                $beehive->type = 'Layens';
                frames($beehive);
                $beehive->save();
                continue;
            }

            if($i > $beehivesApiaryOne + $beehivesApiaryTwo + $beehivesApiaryThree + $beehivesApiaryFour && $i <= $beehivesApiaryOne + $beehivesApiaryTwo + $beehivesApiaryThree + $beehivesApiaryFour + $beehivesApiaryFive) {
                $beehive = new Beehive();
                $beehive->user_id = 1;
                $beehive->apiary_id = 5;
                $beehive->queen_id = $i;
                $beehive->user_code = '' . 1 . 5 . $i;
                $beehive->type = 'Layens';
                frames($beehive);
                $beehive->save();
                continue;
            }

            if($i > $beehivesApiaryOne + $beehivesApiaryTwo + $beehivesApiaryThree + $beehivesApiaryFour + $beehivesApiaryFive && $i <= $beehivesApiaryOne + $beehivesApiaryTwo + $beehivesApiaryThree + $beehivesApiaryFour + $beehivesApiaryFive + $beehivesApiarySix) {
                $beehive = new Beehive();
                $beehive->user_id = 1;
                $beehive->apiary_id = 6;
                $beehive->queen_id = $i;
                $beehive->user_code = '' . 1 . 6 . $i;
                $beehive->type = 'Layens';
                frames($beehive);
                $beehive->save();
                continue;
            }



            // $beehive = new Beehive();
            // $beehive->user_id = 1;
            // $beehive->apiary_id = 3;
            // $beehive->queen_id = $i;
            // $beehive->user_code = '' . 2 . 3 . $i;
            // $beehive->type = 'Layens';
            // frames($beehive);
            // $beehive->save();
        }
    }
}
