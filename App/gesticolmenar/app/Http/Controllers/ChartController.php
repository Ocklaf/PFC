<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\AppChart;
use App\Models\Apiary;
use App\Models\Place;
use App\Models\Beehive;
use App\Models\Product;

class ChartController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function honeyApiaries() {
        $honeyEachApiary = [];
        $apiaryPlaceName = [];
        $inKg = 1000;
        $user = auth()->user()->id;
        $apiaries = Apiary::where('user_id', $user)->get();

        foreach ($apiaries as $apiary) {
            $place_name = Place::where('id', $apiary->place_id)->pluck('name')->first();
            array_push($apiaryPlaceName, $place_name);

            $beehives = Beehive::where('apiary_id', $apiary->id)->get();
            $honey = 0;

            foreach ($beehives as $beehive) {
                $honey += Product::where('beehive_id', $beehive->id)->where('type', 'Miel')->sum('grams')/$inKg;
            }

            array_push($honeyEachApiary, $honey);
        }

        $honeyApiaryChart = new AppChart();
        $honeyApiaryChart->labels($apiaryPlaceName);
        $honeyApiaryChart->dataset('Miel', 'bar', $honeyEachApiary)->color('rgb(161, 90, 40)')->backgroundcolor('rgb(193, 148 , 0)');

        return view('charts.honey', compact('honeyApiaryChart'));
    }

    public function pollenApiaries() {
        $pollenEachApiary = [];
        $apiaryPlaceName = [];
        $inKg = 1000;
        $user = auth()->user()->id;
        $apiaries = Apiary::where('user_id', $user)->get();

        foreach ($apiaries as $apiary) {
            $place_name = Place::where('id', $apiary->place_id)->pluck('name')->first();
            array_push($apiaryPlaceName, $place_name);

            $beehives = Beehive::where('apiary_id', $apiary->id)->get();
            $pollen = 0;

            foreach ($beehives as $beehive) {
                $pollen += Product::where('beehive_id', $beehive->id)->where('type', 'Polen')->sum('grams')/$inKg;
            }

            array_push($pollenEachApiary, $pollen);
        }

        $pollenApiaryChart = new AppChart();
        $pollenApiaryChart->labels($apiaryPlaceName);
        $pollenApiaryChart->dataset('Polen', 'bar', $pollenEachApiary)->color('rgb(161, 90, 40)')->backgroundcolor('rgb(193, 148 , 0)');

        return view('charts.pollen', compact('pollenApiaryChart'));
    }

    public function apitoxineApiaries() {
        $apitoxineEachApiary = [];
        $apiaryPlaceName = [];
        $user = auth()->user()->id;
        $apiaries = Apiary::where('user_id', $user)->get();

        foreach ($apiaries as $apiary) {
            $place_name = Place::where('id', $apiary->place_id)->pluck('name')->first();
            array_push($apiaryPlaceName, $place_name);

            $beehives = Beehive::where('apiary_id', $apiary->id)->get();
            $pollen = 0;

            foreach ($beehives as $beehive) {
                $pollen += Product::where('beehive_id', $beehive->id)->where('type', 'Apitoxina')->sum('grams');
            }

            array_push($apitoxineEachApiary, $pollen);
        }

        $apitoxineApiaryChart = new AppChart();
        $apitoxineApiaryChart->labels($apiaryPlaceName);
        $apitoxineApiaryChart->dataset('Apitoxina', 'bar', $apitoxineEachApiary)->color('rgb(161, 90, 40)')->backgroundcolor('rgb(193, 148 , 0)');

        return view('charts.apitoxine', compact('apitoxineApiaryChart'));
    }
}
