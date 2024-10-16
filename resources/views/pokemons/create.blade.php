@extends('layouts.template')

@section('title', 'Add New Pokemon')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Create Pokémon</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pokemons.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required maxlength="255">
        </div>

        <!-- Species -->
        <div class="mb-3">
            <label for="species" class="form-label">Species</label>
            <input type="text" name="species" class="form-control" id="species" value="{{ old('species') }}" required maxlength="100">
        </div>

         <!-- Primary Type (Dropdown) -->
         <div class="mb-3">
            <label for="primary_type" class="form-label">Primary Type</label>
            <select name="primary_type" id="primary_type" class="form-control" required>
                <option value="">Select a type</option>
                <option value="Grass" {{ old('primary_type') == 'Grass' ? 'selected' : '' }}>Grass</option>
                <option value="Fire" {{ old('primary_type') == 'Fire' ? 'selected' : '' }}>Fire</option>
                <option value="Water" {{ old('primary_type') == 'Water' ? 'selected' : '' }}>Water</option>
                <option value="Bug" {{ old('primary_type') == 'Bug' ? 'selected' : '' }}>Bug</option>
                <option value="Normal" {{ old('primary_type') == 'Normal' ? 'selected' : '' }}>Normal</option>
                <option value="Poison" {{ old('primary_type') == 'Poison' ? 'selected' : '' }}>Poison</option>
                <option value="Electric" {{ old('primary_type') == 'Electric' ? 'selected' : '' }}>Electric</option>
                <option value="Ground" {{ old('primary_type') == 'Ground' ? 'selected' : '' }}>Ground</option>
                <option value="Fairy" {{ old('primary_type') == 'Fairy' ? 'selected' : '' }}>Fairy</option>
                <option value="Fighting" {{ old('primary_type') == 'Fighting' ? 'selected' : '' }}>Fighting</option>
                <option value="Psychic" {{ old('primary_type') == 'Psychic' ? 'selected' : '' }}>Psychic</option>
                <option value="Rock" {{ old('primary_type') == 'Rock' ? 'selected' : '' }}>Rock</option>
                <option value="Ghost" {{ old('primary_type') == 'Ghost' ? 'selected' : '' }}>Ghost</option>
                <option value="Ice" {{ old('primary_type') == 'Ice' ? 'selected' : '' }}>Ice</option>
                <option value="Dragon" {{ old('primary_type') == 'Dragon' ? 'selected' : '' }}>Dragon</option>
                <option value="Dark" {{ old('primary_type') == 'Dark' ? 'selected' : '' }}>Dark</option>
                <option value="Steel" {{ old('primary_type') == 'Steel' ? 'selected' : '' }}>Steel</option>
                <option value="Flying" {{ old('primary_type') == 'Flying' ? 'selected' : '' }}>Flying</option>
            </select>
        </div>


        <!-- Weight -->
        <div class="mb-3">
            <label for="weight" class="form-label">Weight (kg)</label>
            <input type="number" name="weight" class="form-control" id="weight" value="{{ old('weight', 0) }}" step="0.01" max="99999999.99">
        </div>

        <!-- Height -->
        <div class="mb-3">
            <label for="height" class="form-label">Height (m)</label>
            <input type="number" name="height" class="form-control" id="height" value="{{ old('height', 0) }}" step="0.01" max="99999999.99">
        </div>

        <!-- HP -->
        <div class="mb-3">
            <label for="hp" class="form-label">HP</label>
            <input type="number" name="hp" class="form-control" id="hp" value="{{ old('hp', 0) }}" max="9999">
        </div>

        <!-- Attack -->
        <div class="mb-3">
            <label for="attack" class="form-label">Attack</label>
            <input type="number" name="attack" class="form-control" id="attack" value="{{ old('attack', 0) }}" max="9999">
        </div>

        <!-- Defense -->
        <div class="mb-3">
            <label for="defense" class="form-label">Defense</label>
            <input type="number" name="defense" class="form-control" id="defense" value="{{ old('defense', 0) }}" max="9999">
        </div>

        <!-- Is Legendary -->
        <div class="mb-3 form-check">
            <input type="checkbox" name="is_legendary" class="form-check-input" id="is_legendary" {{ old('is_legendary') ? 'checked' : '' }}>
            <label class="form-check-label" for="is_legendary">Is Legendary</label>
        </div>

        <!-- Photo -->
        <div class="mb-3">
            <label for="photo" class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control" id="photo" accept="image/*">
            <small class="form-text text-muted">Max file size: 2048 KB. Supported formats: jpeg, jpg, png, gif, svg.</small>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
