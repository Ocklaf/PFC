<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\AppChart;
use App\Models\Apiary;
use App\Models\Place;
use App\Models\Beehive;
use App\Models\Product;

class ChartController extends Controller
{
    const BG_CHART_LINE = 'rgb(161, 90, 40)';
    const BG_CHART_COLUMN = 'rgb(193, 148 , 0)';

    private function getTotalProductYear($id, $product, $year, $magnitudeDivider)
    {
        return Product::where('beehive_id', $id)
                    ->where('type', $product)
                    ->where('year', $year)
                    ->sum('grams') / $magnitudeDivider;
    }

    private function getChart($label, $legendName, $data)
    {
        $chart = new AppChart();
        $chart->labels($label)
            ->options(['legend' => false])
            ->dataset($legendName, 'bar', $data)
                ->color(self::BG_CHART_LINE)
                ->backgroundcolor(self::BG_CHART_COLUMN);

        return $chart;
    }

    private function getUser()
    {
        return auth()->user()->id;
    }

    private function getApiaries()
    {
        $user = $this->getUser();
        return Apiary::where('user_id', $user)->get();
    }

    private function getPlaceName($apiary)
    {
        return Place::where('id', $apiary)->pluck('name')->first();
    }

    private function getBeehives($apiary)
    {
        return Beehive::where('apiary_id', $apiary)->get();
    }

    public function getAllPlacesName()
    {
        $apiaryPlaceName = [];
        $apiaries = $this->getApiaries();

        foreach ($apiaries as $apiary) {
            $placeName = $this->getPlaceName($apiary->place_id);
            array_push($apiaryPlaceName, $placeName);
        }

        return $apiaryPlaceName;
    }

    public function getTotalEachApiary($product, $year, $weightConvert)
    {

        $productEachApiary = [];
        $apiaries = $this->getApiaries();

        foreach ($apiaries as $apiary) {
            $beehives = $this->getBeehives($apiary->id);
            $totalProduct = 0;
            foreach ($beehives as $beehive) {
                $totalProduct += $this->getTotalProductYear($beehive->id, $product, $year, $weightConvert);
            }
            array_push($productEachApiary, $totalProduct);
        }

        return $productEachApiary;
    }

    public function getTotalProductEachYear($years, $product, $weightConvert)
    {
        $eachYear = [];
        $apiaries = $this->getApiaries();

        foreach ($years as $year) {
            $totalProduct = 0;
            foreach ($apiaries as $apiary) {
                $beehives = $this->getBeehives($apiary->id);
                foreach ($beehives as $beehive) {
                    $totalProduct += $this->getTotalProductYear($beehive->id, $product, $year, $weightConvert);
                }
            }
            array_push($eachYear, $totalProduct);
        }

        return $eachYear;
    }

    public function getYearsInRevesedArray($years)
    {
        return array_reverse(json_decode($years));
    }

    /**
     * Display a listing of the resource.
     */
    public function honeyApiaries(Request $request)
    {
        $honeyEachApiary = $this->getTotalEachApiary('Miel', $request->year, 1000);
        $apiaryPlaceName = $this->getAllPlacesName();
        $honeyApiaryChart = $this->getChart($apiaryPlaceName, 'Miel', $honeyEachApiary);

        return view('charts.honey', compact('honeyApiaryChart'));
    }

    public function totalHoney($years)
    {
        $years = $this->getYearsInRevesedArray($years);
        $honeyEachYear = $this->getTotalProductEachYear($years, 'Miel', 1000);
        $honeyApiaryChart = $this->getChart($years, 'Miel', $honeyEachYear);

        return view('charts.totalHoney', compact('honeyApiaryChart'));
    }

    public function pollenApiaries(Request $request)
    {
        $pollenEachApiary = $this->getTotalEachApiary('Polen', $request->year, 1000);
        $apiaryPlaceName = $this->getAllPlacesName();
        $pollenApiaryChart = $this->getChart($apiaryPlaceName, 'Polen', $pollenEachApiary);

        return view('charts.pollen', compact('pollenApiaryChart'));
    }

    public function totalPollen($years)
    {
        $years = $this->getYearsInRevesedArray($years);
        $pollenEachYear = $this->getTotalProductEachYear($years, 'Polen', 1000);
        $pollenApiaryChart = $this->getChart($years, 'Polen', $pollenEachYear);

        return view('charts.totalPollen', compact('pollenApiaryChart'));
    }

    public function apitoxineApiaries(Request $request)
    {
        $apitoxineEachApiary = $this->getTotalEachApiary('Apitoxina', $request->year, 1);
        $apiaryPlaceName = $this->getAllPlacesName();
        $apitoxineApiaryChart = $this->getChart($apiaryPlaceName, 'Apitoxina', $apitoxineEachApiary);

        return view('charts.apitoxine', compact('apitoxineApiaryChart'));
    }

    public function totalApitoxine($years)
    {
        $years = $this->getYearsInRevesedArray($years);
        $apitoxineEachYear = $this->getTotalProductEachYear($years, 'Apitoxina', 1);
        $apitoxineApiaryChart = $this->getChart($years, 'Apitoxina', $apitoxineEachYear);

        return view('charts.totalApitoxine', compact('apitoxineApiaryChart'));
    }
}
