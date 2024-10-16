<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class PokemonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         // $articles = Article::all();
         $pokemons = Pokemon::paginate(10);
         return view('pokemons.index', compact('pokemons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pokemons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'species' => 'required|string|max:100',
        'primary_type' => 'required|string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
        'weight' => 'nullable|numeric|max:99999999.99',
        'height' => 'nullable|numeric|max:99999999.99',
        'hp' => 'nullable|integer|max:9999',
        'attack' => 'nullable|integer|max:9999',
        'defense' => 'nullable|integer|max:9999',
        'is_legendary' => 'sometimes|boolean',
        'photo' => 'nullable|image|max:2048|mimes:jpeg,jpg,png,gif,svg',
    ]);

    // Upload foto jika ada
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('photos', 'public');
    }

    // Membuat data pokemon baru
    $pokemon = Pokemon::create([
        'name' => $validated['name'],
        'species' => $validated['species'],
        'primary_type' => $validated['primary_type'],
        'weight' => $validated['weight'] ?? 0, // Set default jika null
        'height' => $validated['height'] ?? 0, // Set default jika null
        'hp' => $validated['hp'] ?? 0, // Set default jika null
        'attack' => $validated['attack'] ?? 0, // Set default jika null
        'defense' => $validated['defense'] ?? 0, // Set default jika null
        'is_legendary' => $request->has('is_legendary') ? true : false, // Checkbox input
        'photo' => $photoPath, // Path foto yang diunggah
    ]);

    // Update data Pokémon
    $pokemon->update([
        'name' => $validated['name'],
        'species' => $validated['species'],
        'primary_type' => $validated['primary_type'],
        'weight' => $validated['weight'] ?? 0,
        'height' => $validated['height'] ?? 0,
        'hp' => $validated['hp'] ?? 0,
        'attack' => $validated['attack'] ?? 0,
        'defense' => $validated['defense'] ?? 0,
        'is_legendary' => $request->has('is_legendary'),
        'photo' => $request->hasFile('photo') ? $photoPath : $pokemon->photo, // Gunakan foto lama jika tidak ada foto baru
    ]);

    // Mengembalikan data yang telah diperbarui atau redirect ke halaman lain
    return redirect()->route('pokemons.index')->with('success', 'Pokémon updated successfully!');
}


    /**
     * Display the specified resource.
     */
    public function show(Pokemon $pokemon)
    {
        return view('pokemons.show', compact('pokemon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokemon $pokemon)
    {
        return view('pokemons.edit', compact('pokemon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pokemon $pokemon)
    {
         // Validasi input
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'species' => 'required|string|max:100',
        'primary_type' => 'required|string|in:Grass,Fire,Water,Bug,Normal,Poison,Electric,Ground,Fairy,Fighting,Psychic,Rock,Ghost,Ice,Dragon,Dark,Steel,Flying',
        'weight' => 'nullable|numeric|max:99999999.99',
        'height' => 'nullable|numeric|max:99999999.99',
        'hp' => 'nullable|integer|max:9999',
        'attack' => 'nullable|integer|max:9999',
        'defense' => 'nullable|integer|max:9999',
        'is_legendary' => 'sometimes|boolean',
        'photo' => 'nullable|image|max:2048|mimes:jpeg,jpg,png,gif,svg',
    ]);

    // Cek apakah ada file foto yang diunggah
    if ($request->hasFile('photo')) {
        // Simpan foto dan ambil path-nya
        $photoPath = $request->file('photo')->store('photos', 'public');
        $pokemon->photo = $photoPath; // Update path foto
    }

    // Update data Pokémon
    $pokemon->name = $validated['name'];
    $pokemon->species = $validated['species'];
    $pokemon->primary_type = $validated['primary_type'];
    $pokemon->weight = $validated['weight'] ?? 0; // Set default jika null
    $pokemon->height = $validated['height'] ?? 0; // Set default jika null
    $pokemon->hp = $validated['hp'] ?? 0; // Set default jika null
    $pokemon->attack = $validated['attack'] ?? 0; // Set default jika null
    $pokemon->defense = $validated['defense'] ?? 0; // Set default jika null
    $pokemon->is_legendary = $request->has('is_legendary'); // Checkbox input

    // Simpan perubahan ke database
    $pokemon->save();

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('pokemons.index')->with('success', 'Pokémon updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokemon $pokemon)
    {
        if ($pokemon->image) {
            Storage::delete($pokemon->image);
        }
        $pokemon->delete();
        return redirect()->route('pokemons.index')->with('success', 'Pokedex deleted successfully.');
    }




}
