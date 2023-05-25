<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queen;

function getColor($year)
{
    
    $lastDigitYear = (substr($year, -1));

    $colors = [
        '0' => 'Azul',
        '1' => 'Blanco',
        '2' => 'Amarillo',
        '3' => 'Rojo',
        '4' => 'Verde',
        '5' => 'Azul',
        '6' => 'Blanco',
        '7' => 'Amarillo',
        '8' => 'Rojo',
        '9' => 'Verde',
    ];

    return $colors[$lastDigitYear];
}

class QueenController extends Controller
{
    public function getUser()
    {
        return auth()->user()->id;
    }

    public function save($queen, $request)
    {
        $queen->user_id = $this->getUser();
        $queen->race = $request->race;
        $queen->color = $request->color;
        $queen->start_date = $request->start_date;
        $queen->end_date = $request->end_date;
        $request->is_inseminated == 'on' ? $queen->is_inseminated = true : $queen->is_inseminated = false;
        $request->is_zanganera == 'on' ? $queen->is_zanganera = true : $queen->is_zanganera = false;
        $request->is_new_blood == 'on' ? $queen->is_new_blood = true : $queen->is_new_blood = false;
        $queen->save();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = $this->getUser();
        $queens = Queen::where('user_id', $user)
            ->whereNotIn('id', function ($query) {
                $query->select('queen_id')->from('beehives');
            })->get();

        return view('queens.index', compact('queens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $queen = new Queen();
        $queen->color = getColor(date('Y'));
        $queen->start_date = date('Y');
        $queen->end_date = date('Y') + 5;
        $queen->is_inseminated = false;
        $queen->is_zanganera = false;
        $queen->is_new_blood = false;

        $path = 'queens.store';
        $races = ['Ibérica', 'Italiana', 'Europea', 'Cárnica', 'Africana'];

        return view('queens.form', compact('queen', 'path', 'races'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $queen = new Queen();
        $this->save($queen, $request);

        return redirect()->route('queens.index')->withSuccess('Reina creada correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $queen = Queen::findOrFail($id);
        $path = 'queens.update';
        $races = ['Ibérica', 'Italiana', 'Europea', 'Cárnica', 'Africana'];

        return view('queens.form', compact('queen', 'path', 'races'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $queen = Queen::findOrFail($id);
        $this->save($queen, $request);

        return redirect()->route('queens.index')->withSuccess('Reina editada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $queen = Queen::findOrFail($id);
        $queen->delete();

        return redirect()->route('queens.index')->withSuccess('Reina eliminada correctamente');
    }
}
