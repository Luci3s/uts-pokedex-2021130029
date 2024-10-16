<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('landing');
// });

use App\Http\Controllers\PokemonController;
use App\Http\Controllers\LandingController;
use App\Models\Pokemon;

Route::resource('pokemons', PokemonController::class);
// Route::resource('pokemons', LandingController::class);
Route::get('/', LandingController::class)->name('landing');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/pokemons', [PokemonController::class, 'index'])->name('pokemons.index');
    Route::get('/pokemons/create', [PokemonController::class, 'create'])->name('pokemons.create');
    Route::post('/pokemons', [PokemonController::class, 'store'])->name('pokemons.store');
    Route::get('/pokemons/{pokemon}', [PokemonController::class, 'show'])->name('pokemons.show');
    Route::get('/pokemons/{pokemon}/edit', [PokemonController::class, 'edit'])->name('pokemons.edit');
    Route::put('/pokemons/{pokemon}', [PokemonController::class, 'update'])->name('pokemons.update');
    Route::delete('/pokemons/{pokemon}', [PokemonController::class, 'destroy'])->name('pokemons.destroy');
});
