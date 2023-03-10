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
        $beehivesApiaryOne = 180;
        $beehivesApiaryTwo = 120;
        $beehivesApiatyThree = 300;

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
            $product->type = 'Miel';
            $product->grams = rand(12000, 15000);
            $product->save();

            $product = new Product();
            $product->user_id = 1;
            $product->beehive_id = $i + $beehivesApiaryOne;
            $product->type = 'Polen';
            $product->grams = rand(900, 1500);
            $product->save();
        }

        for ($i = 1; $i <= $beehivesApiatyThree; $i++) {
            $product = new Product();
            $product->user_id = 2;
            $product->beehive_id = $i + $beehivesApiaryOne + $beehivesApiaryTwo;
            $product->type = 'Apitoxina';
            $product->grams = rand(1, 3);
            $product->save();
        }
    }
}
