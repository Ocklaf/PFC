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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = auth()->user()->id;
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
        $queen->user_id = auth()->user()->id;
        $queen->race = $request->race;
        $queen->color = $request->color;
        $queen->start_date = $request->start_date;
        $queen->end_date = $request->end_date;
        $queen->save();

        return redirect()->route('apiaries.index')->withSuccess('Reina creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
