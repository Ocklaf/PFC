<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beehive;
use App\Models\Queen;
use App\Http\Requests\BeehiveRequest;
use App\Models\Place;
use App\Models\Apiary;
use App\Models\Product;
use App\Models\Disease;

class BeehiveController extends Controller
{
    public function getBeehive($id)
    {
        return Beehive::findOrFail($id);
    }

    public function getUser()
    {
        return auth()->user()->id;
    }

    public function save($beehive, $request)
    {
        $beehive->type = $request->type;
        $beehive->user_code = $request->user_code;
        $beehive->honey_frames = $request->honey_frames;
        $beehive->pollen_frames = $request->pollen_frames;
        $beehive->brood_frames = $request->brood_frames;
        $beehive->user_id = $this->getUser();
        $beehive->apiary_id = $request->apiary_id;
        $beehive->queen_id = $request->queen_id;
        $beehive->save();
    }

    public function beehivesApiary($apiary)
    {
        $beehives = Beehive::where('apiary_id', $apiary)->paginate(8);
        $queensToChange = Queen::where('end_date', '=', date('Y'))->get();
        $queensNoInseminated = Queen::where('is_inseminated', '=', '0')->get();
        $queensZanganera = Queen::where('is_zanganera', '=', '1')->get();

        foreach ($beehives as $beehive) {
            foreach ($queensToChange as $queenToChange) {
                if ($beehive->queen_id == $queenToChange->id) {
                    $beehive->queen_change = true;
                }
            }
            foreach ($queensNoInseminated as $queenNoInseminated) {
                if ($beehive->queen_id == $queenNoInseminated->id) {
                    $beehive->queen_no_inseminated = true;
                }
            }
            foreach ($queensZanganera as $queenZanganera) {
                if ($beehive->queen_id == $queenZanganera->id) {
                    $beehive->queen_zanganera = true;
                }
            }
        }

        return view('beehives.index', compact('beehives', 'apiary'));
    }

    public function addBeehiveToApiary($apiary)
    {
        $beehive = new Beehive();
        $path = 'beehives.store';
        $user = $this->getUser();
        $freeQueens = Queen::where('user_id', $user)
            ->whereNotIn('id', function ($query) {
                $query->select('queen_id')->from('beehives');
            })->get();
        $apiaries = [];

        return view('beehives.form', compact('beehive', 'path', 'freeQueens', 'apiary', 'apiaries'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(BeehiveRequest $request)
    {
        $beehive = new Beehive();
        $this->save($beehive, $request);

        return redirect()
            ->route('beehives.beehivesApiary', $beehive->apiary_id)
            ->withSuccess('Colmena creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $beehive = $this->getBeehive($id);
        $beehive->place_name = Place::where('id', $beehive->apiary_id)->pluck('name')->first();
        $queen = Queen::where('id', $beehive->queen_id)->first();
        $products = Product::where('beehive_id', $id)->where('year', date('Y'))->get();
        $diseases = Disease::where('beehive_id', $id)->get();

        return view('beehives.show', compact('beehive', 'queen', 'products', 'diseases'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $beehive = $this->getBeehive($id);
        $path = 'beehives.update';
        $user = $this->getUser();
        $actualQueen = Queen::where('id', $beehive->queen_id)->get();

        $freeQueens = Queen::where('user_id', $user)
            ->whereNotIn('id', function ($query) {
                $query->select('queen_id')->from('beehives');
            })->get();

        $freeQueens->prepend($actualQueen->first());

        $apiaries = Apiary::where('user_id', $user)->get();

        foreach ($apiaries as $apiary) {
            $apiary->place_name = Place::where('id', $apiary->place_id)->pluck('name')->first();
        }

        return view('beehives.form', compact('beehive', 'path', 'freeQueens', 'apiaries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BeehiveRequest $request, string $id)
    {

        $beehive = $this->getBeehive($id);
        $this->save($beehive, $request);

        return redirect()
            ->route('beehives.beehivesApiary', $beehive->apiary_id)
            ->withSuccess('Colmena actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $beehive = $this->getBeehive($id);

        $beehive->delete();

        return redirect()
            ->route('beehives.beehivesApiary', $beehive->apiary_id)
            ->withSuccess('Colmena eliminada correctamente');
    }
}
