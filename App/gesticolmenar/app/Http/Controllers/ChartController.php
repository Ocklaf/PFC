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
    public function honeyApiaries(Request $request) {
        // dd($request->year);
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
                $honey += Product::where('beehive_id', $beehive->id)->where('type', 'Miel')->where('year', $request->year)->sum('grams') / $inKg;
            }

            array_push($honeyEachApiary, $honey);
        }

        $honeyApiaryChart = new AppChart();
        $honeyApiaryChart->labels($apiaryPlaceName);
        $honeyApiaryChart->dataset('Miel', 'bar', $honeyEachApiary)->color('rgb(161, 90, 40)')->backgroundcolor('rgb(193, 148 , 0)');

        return view('charts.honey', compact('honeyApiaryChart'));
    }

    public function totalHoney($years) {

        $years = array_reverse(json_decode($years));

        $honeyEachYear = [];
        $inKg = 1000;
        $user = auth()->user()->id;
        $apiaries = Apiary::where('user_id', $user)->get();

        foreach ($years as $year) {
            $honey = 0;
        foreach ($apiaries as $apiary) {

            $beehives = Beehive::where('apiary_id', $apiary->id)->get();

                //dd($years);
                foreach ($beehives as $beehive) {
                    $honey += Product::where('beehive_id', $beehive->id)->where('type', 'Miel')->where('year', $year . "")->sum('grams') / $inKg;
                }
            }
            array_push($honeyEachYear, $honey);
        }

       // dd($honeyEachYear);

        $honeyApiaryChart = new AppChart();
        $honeyApiaryChart->labels($years);
        $honeyApiaryChart->dataset('Miel', 'bar', $honeyEachYear)->color('rgb(161, 90, 40)')->backgroundcolor('rgb(193, 148 , 0)');

        return view('charts.totalHoney', compact('honeyApiaryChart'));
    }

    public function pollenApiaries(Request $request) {
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
                $pollen += Product::where('beehive_id', $beehive->id)->where('type', 'Polen')->where('year', $request->year)->sum('grams') / $inKg;
            }

            array_push($pollenEachApiary, $pollen);
        }

        $pollenApiaryChart = new AppChart();
        $pollenApiaryChart->labels($apiaryPlaceName);
        $pollenApiaryChart->dataset('Polen', 'bar', $pollenEachApiary)->color('rgb(161, 90, 40)')->backgroundcolor('rgb(193, 148 , 0)');

        return view('charts.pollen', compact('pollenApiaryChart'));
    }

    public function totalPollen($years) {

        $years = array_reverse(json_decode($years));

        $pollenEachYear = [];
        $inKg = 1000;
        $user = auth()->user()->id;
        $apiaries = Apiary::where('user_id', $user)->get();

        foreach ($years as $year) {
            $pollen = 0;
        foreach ($apiaries as $apiary) {

            $beehives = Beehive::where('apiary_id', $apiary->id)->get();

                foreach ($beehives as $beehive) {
                    $pollen += Product::where('beehive_id', $beehive->id)->where('type', 'Polen')->where('year', $year)->sum('grams') / $inKg;
                }
            }
            array_push($pollenEachYear, $pollen);
        }

        //dd($pollenEachYear);

        $pollenApiaryChart = new AppChart();
        $pollenApiaryChart->labels($years);
        $pollenApiaryChart->dataset('Polen', 'bar', $pollenEachYear)->color('rgb(161, 90, 40)')->backgroundcolor('rgb(193, 148 , 0)');
        //dd($pollenApiaryChart);
        return view('charts.totalPollen', compact('pollenApiaryChart'));
    }

    public function apitoxineApiaries(Request $request) {
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
                $pollen += Product::where('beehive_id', $beehive->id)->where('type', 'Apitoxina')->where('year', $request->year)->sum('grams');
            }

            array_push($apitoxineEachApiary, $pollen);
        }

        $apitoxineApiaryChart = new AppChart();
        $apitoxineApiaryChart->labels($apiaryPlaceName);
        $apitoxineApiaryChart->dataset('Apitoxina', 'bar', $apitoxineEachApiary)->color('rgb(161, 90, 40)')->backgroundcolor('rgb(193, 148 , 0)');

        return view('charts.apitoxine', compact('apitoxineApiaryChart'));
    }

    public function totalApitoxine($years) {

        $years = array_reverse(json_decode($years));

        $apitoxineEachYear = [];
        $user = auth()->user()->id;
        $apiaries = Apiary::where('user_id', $user)->get();

        foreach ($years as $year) {
            $apitoxine = 0;
        foreach ($apiaries as $apiary) {

            $beehives = Beehive::where('apiary_id', $apiary->id)->get();

                foreach ($beehives as $beehive) {
                    $apitoxine += Product::where('beehive_id', $beehive->id)->where('type', 'Apitoxina')->where('year', $year)->sum('grams');
                }
            }
            array_push($apitoxineEachYear, $apitoxine);
        }

        //dd($pollenEachYear);

        $apitoxineApiaryChart = new AppChart();
        $apitoxineApiaryChart->labels($years);
        $apitoxineApiaryChart->dataset('Polen', 'bar', $apitoxineEachYear)->color('rgb(161, 90, 40)')->backgroundcolor('rgb(193, 148 , 0)');
        //dd($pollenApiaryChart);
        return view('charts.totalApitoxine', compact('apitoxineApiaryChart'));
    }
}
