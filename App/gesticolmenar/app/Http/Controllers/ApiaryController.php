<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apiary;
use App\Models\Place;
use App\Models\Beehive;
use App\Models\Product;
use App\Models\Disease;
use App\Http\Requests\ApiaryRequest;

class ApiaryController extends Controller
{

    public function getUser()
    {
        return auth()->user()->id;
    }

    public function getApiary($id)
    {
        return Apiary::findOrFail($id);
    }

    public function years()
    {

        $user = $this->getUser();
        $years = [];
        $minYears = Product::where('user_id', $user)->min('year');

        if ($minYears) {
            for ($i = date('Y'); $i >= $minYears; $i--) {
                array_push($years, $i);
            }
        } else {
            array_push($years, date('Y'));
        }

        return $years;
    }

    public function freePlaces()
    {
        return Place::where('user_id', $this->getUser())
            ->whereNotIn('id', function ($query) {
                $query->select('place_id')->from('apiaries');
            })->get();
    }

    public function save($apiary, $request)
    {
        $apiary->beehives_quantity = 0;
        $apiary->place_id = $request->place_id;
        $apiary->last_visit = $request->last_visit;
        $apiary->next_visit = $request->next_visit;
        $request->clear_apiary == 'on' ? $apiary->clear_apiary = true : $apiary->clear_apiary = false;
        $request->refill_water == 'on' ? $apiary->refill_water = true : $apiary->refill_water = false;
        $request->collect_honey == 'on' ? $apiary->collect_honey = true : $apiary->collect_honey = false;
        $request->collect_pollen == 'on' ? $apiary->collect_pollen = true : $apiary->collect_pollen = false;
        $request->collect_apitoxine == 'on' ? $apiary->collect_apitoxine = true : $apiary->collect_apitoxine = false;
        $request->food == 'on' ? $apiary->food = true : $apiary->food = false;
        $apiary->others = $request->others;
        $apiary->save();
    }

    public function apiariesTasks()
    {

        $user = $this->getUser();
        $apiariesTasks = Apiary::where('user_id', $user)->where('next_visit', '>=', date('Y-m-d'))->get();
        $beehivesWithDiseases = Beehive::whereIn('id', function ($query) {
            $user = $this->getUser();
            $query->select('beehive_id')
                ->from('diseases')
                ->where('user_id', $user)
                ->where('treatment_repeat_date', '>=', date('Y-m-d'));
        })->get();

        foreach ($beehivesWithDiseases as $beehiveDisease) {
            $diseases = Disease::where('beehive_id', $beehiveDisease->id)->get();
            $beehiveDisease->diseases = $diseases;
            $beehiveDisease->place_name = Place::where('id', $beehiveDisease->apiary_id)->pluck('name')->first();
        }

        foreach ($apiariesTasks as $apiaryTask) {
            $apiaryTask->place_name = Place::where('id', $apiaryTask->place_id)->pluck('name')->first();
        }

        return view('apiaries.tasks', compact('apiariesTasks', 'beehivesWithDiseases'));
    }

    public function index()
    {

        $user = $this->getUser();
        $apiaries = Apiary::where('user_id', $user)->get();
        $apiariesTasks = Apiary::where('user_id', $user)->where('next_visit', '>=', date('Y-m-d'))->get()->count();
        $beehivesWithDiseases = Beehive::whereIn('id', function ($query) {
            $user = $this->getUser();
            $query->select('beehive_id')
                ->from('diseases')
                ->where('user_id', $user)
                ->where('treatment_repeat_date', '>=', date('Y-m-d'));
        })->count();
        $totalTasks = $beehivesWithDiseases + $apiariesTasks;

        foreach ($apiaries as $apiary) {
            $apiary->place_name = Place::where('id', $apiary->place_id)->pluck('name')->first();
            $apiary->beehives_quantity = Beehive::where('apiary_id', $apiary->id)->count();
        }

        $years = $this->years();

        return view('apiaries.index', compact('apiaries', 'years', 'totalTasks'));
    }

    public function create()
    {

        $apiary = new Apiary();
        $path = 'apiaries.store';
        $freePlaces = $this->freePlaces();

        return view('apiaries.form', compact('apiary', 'path', 'freePlaces'));
    }

    public function store(Request $request)
    {

        $apiary = new Apiary();
        $apiary->user_id = $this->getUser();
        $this->save($apiary, $request);

        return redirect()->route('apiaries.index')->withSuccess('Colmenar creado correctamente');
    }

    public function edit(string $id)
    {

        $apiary = $this->getApiary($id);
        $path = 'apiaries.update';
        $freePlaces = $this->freePlaces();
        $freePlaces->prepend(Place::where('id', $apiary->place_id)->get()->first());

        return view('apiaries.form', compact('apiary', 'path', 'freePlaces'));
    }

    public function update(ApiaryRequest $request, string $id)
    {

        $apiary = $this->getApiary($id);
        $this->save($apiary, $request);

        return redirect()->route('apiaries.index')->withSuccess('Colmenar actualizado correctamente');
    }

    public function destroy(string $id)
    {

        $apiary = $this->getApiary($id);
        $apiary->delete();

        return redirect()->route('apiaries.index');
    }
}
