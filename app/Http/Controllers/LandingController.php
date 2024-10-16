<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $pokemons = Pokemon::query()->latest()->paginate(9);
        return view('landing', compact('pokemons'));

    }
}
