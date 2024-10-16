@extends('layouts.template')

@section('title', $pokemon->title)

@section('content')
<article class="blog-post my-4">
    <h1 class="display-5 fw-bold">{{ $pokemon->name }}</h1>
    <p class="blog-post-meta">Updated at: {{ $pokemon->updated_at }}</p>

    @if ($pokemon->photo)
    <img src="{{ asset(str_replace('public/', '/storage/', $pokemon->photo)) }}" alt="{{ $pokemon->name }}" class="img-fluid">
    {{-- <img src="{{ asset('storage/' . $pokemon->photo) }}" alt="{{ $pokemon->name }}" class="img-fluid"> --}}
    {{-- <img src="{{ asset('storage/' . $shop->product_img) }}" alt="{{ $shop->product_name }}" class="img-fluid"> --}}
    @else

    <img src="https://placehold.co/200" alt="Placeholder">
    @endif

    <p><strong>Species:</strong> {{ $pokemon->species }}</p>
    <p><strong>Primary Type:</strong> {{ $pokemon->primary_type }}</p>
    <p><strong>Weight:</strong> {{ $pokemon->weight }} kg</p>
    <p><strong>Height:</strong> {{ $pokemon->height }} m</p>
    <p><strong>HP:</strong> {{ $pokemon->hp }}</p>
    <p><strong>Attack:</strong> {{ $pokemon->attack }}</p>
    <p><strong>Defense:</strong> {{ $pokemon->defense }}</p>
    <p><strong>Is Legendary:</strong> {{ $pokemon->is_legendary ? 'Yes' : 'No' }}</p>
</article>

<div class="d-flex justify-content-between">
    <a href="{{ route('pokemons.index') }}" class="btn btn-primary">Back to Pokémon List</a>
    {{-- <a href="{{ route('pokemons.edit', $pokemon->id) }}" class="btn btn-warning">Edit</a> --}}
</div>

@endsection
