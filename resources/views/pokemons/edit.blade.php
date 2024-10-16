@extends('layouts.template')

@section('title', 'Update Pokemon')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Pokémon</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pokemons.update', $pokemon) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $pokemon->name) }}" required maxlength="255">
        </div>

        <div class="mb-3">
            <label for="species" class="form-label">Species</label>
            <input type="text" class="form-control" id="species" name="species" value="{{ old('species', $pokemon->species) }}" required maxlength="100">
        </div>

        <div class="mb-3">
            <label for="primary_type" class="form-label">Primary Type</label>
            <select class="form-select" id="primary_type" name="primary_type" required>
                <option value="">Select Type</option>
                @foreach (['Grass', 'Fire', 'Water', 'Bug', 'Normal', 'Poison', 'Electric', 'Ground', 'Fairy', 'Fighting', 'Psychic', 'Rock', 'Ghost', 'Ice', 'Dragon', 'Dark', 'Steel', 'Flying'] as $type)
                    <option value="{{ $type }}" {{ old('primary_type', $pokemon->primary_type) == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="weight" class="form-label">Weight</label>
            <input type="number" class="form-control" id="weight" name="weight" value="{{ old('weight', $pokemon->weight) }}" step="0.01" max="99999999.99">
        </div>

        <div class="mb-3">
            <label for="height" class="form-label">Height</label>
            <input type="number" class="form-control" id="height" name="height" value="{{ old('height', $pokemon->height) }}" step="0.01" max="99999999.99">
        </div>

        <div class="mb-3">
            <label for="hp" class="form-label">HP</label>
            <input type="number" class="form-control" id="hp" name="hp" value="{{ old('hp', $pokemon->hp) }}" max="9999">
        </div>

        <div class="mb-3">
            <label for="attack" class="form-label">Attack</label>
            <input type="number" class="form-control" id="attack" name="attack" value="{{ old('attack', $pokemon->attack) }}" max="9999">
        </div>

        <div class="mb-3">
            <label for="defense" class="form-label">Defense</label>
            <input type="number" class="form-control" id="defense" name="defense" value="{{ old('defense', $pokemon->defense) }}" max="9999">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="is_legendary" name="is_legendary" {{ old('is_legendary', $pokemon->is_legendary) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_legendary">Is Legendary</label>
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/jpeg,image/png,image/gif,image/svg+xml">
            <small class="form-text text-muted">Current Photo: @if($pokemon->photo) <img src="{{ asset('storage/' . $pokemon->photo) }}" alt="{{ $pokemon->name }}" style="max-width: 100px;"/> @else No photo @endif</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Pokémon</button>
        <a href="{{ route('pokemons.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
