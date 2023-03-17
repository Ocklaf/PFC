<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beehivesApiaryOne = 20;
        $beehivesApiaryTwo = 10;
        $beehivesApiaryThree = 5;
        $beehivesApiaryFour = 15;
        $beehivesApiaryFive = 30;
        $beehivesApiarySix = 25;

        for ($i = 1; $i <= $beehivesApiaryOne; $i++) {
            $product = new Product();
            $product->user_id = 1;
            $product->beehive_id = $i;
            $product->type = 'Miel';
            $product->grams = rand(18000, 21000);
            $product->save();
        }

        for ($i = 1; $i <= $beehivesApiaryTwo; $i++) {
            $product = new Product();
            $product->user_id = 1;
            $product->beehive_id = $i + $beehivesApiaryOne;
            $product->type = 'Polen';
            $product->grams = rand(900, 1500);
            $product->save();
        }

        for ($i = 1; $i <= $beehivesApiaryThree; $i++) {
            $product = new Product();
            $product->user_id = 1;
            $product->beehive_id = $i + $beehivesApiaryOne + $beehivesApiaryTwo;
            $product->type = 'Apitoxina';
            $product->grams = rand(1, 3);
            $product->save();
        }

        for ($i = 1; $i <= $beehivesApiaryFour; $i++) {
            $product = new Product();
            $product->user_id = 1;
            $product->beehive_id = $i + $beehivesApiaryOne + $beehivesApiaryTwo + $beehivesApiaryThree;
            $product->type = 'Miel';
            $product->grams = rand(18000, 21000);
            $product->save();

            $product = new Product();
            $product->user_id = 1;
            $product->beehive_id = $i + $beehivesApiaryOne + $beehivesApiaryTwo + $beehivesApiaryThree;
            $product->type = 'Polen';
            $product->grams = rand(900, 1500);
            $product->save();

            $product = new Product();
            $product->user_id = 1;
            $product->beehive_id = $i + $beehivesApiaryOne + $beehivesApiaryTwo + $beehivesApiaryThree;
            $product->type = 'Apitoxina';
            $product->grams = rand(1, 3);
            $product->save();
        }

        for ($i = 1; $i <= $beehivesApiaryFive; $i++) {
            $product = new Product();
            $product->user_id = 1;
            $product->beehive_id = $i + $beehivesApiaryOne + $beehivesApiaryTwo + $beehivesApiaryThree + $beehivesApiaryFour;
            $product->type = 'Miel';
            $product->grams = rand(18000, 21000);
            $product->save();
        }

        for ($i = 1; $i <= $beehivesApiarySix; $i++) {
            $product = new Product();
            $product->user_id = 1;
            $product->beehive_id = $i + $beehivesApiaryOne + $beehivesApiaryTwo + $beehivesApiaryThree + $beehivesApiaryFour + $beehivesApiaryFive;
            $product->type = 'Miel';
            $product->grams = rand(18000, 21000);
            $product->save();
        }
    }
}
