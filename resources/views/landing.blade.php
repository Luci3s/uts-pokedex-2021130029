@extends('layouts.template')

@section('title', 'Pokedex')

@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach ($pokemons as $pokemon)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset(str_replace('public/', '/storage/', $pokemon->photo)) }}" alt="{{ $pokemon->name }}" class="img-fluid" class="card-img-top" alt="{{ $pokemon->name }}" style="cursor: pointer;" onclick="location.href='{{ route('pokemons.show', $pokemon) }}'">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('pokemons.show', $pokemon) }}">{{ $pokemon->name }}</a>
                        </h5>
                        <p class="card-text">
                            <strong>ID:</strong> {{ str_pad($pokemon->id, 4, '0', STR_PAD_LEFT) }}
                        </p>
                        <p class="card-text">
                            <strong>Type:</strong>
                            <span class="badge bg-primary">{{ $pokemon->primary_type }}</span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="d-flex justify-content-center">
    {{ $pokemons->links() }}
    </div>
@endsection
