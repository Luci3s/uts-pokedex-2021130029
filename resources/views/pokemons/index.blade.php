@extends('layouts.template')

@section('title','Pokemon List')

@section('content')
<div class="mt-4 p-5 bg-black text-white rounded">
    <h1>All Pokémon</h1>
    <a href="{{ route('pokemons.create') }}" class="btn btn-primary">Create Pokémon</a>
</div>

<div class="container mt-5">
    <table class="table table-bordered mb-5">
        <thead>
            <tr class="table-success">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Species</th>
                <th scope="col">Primary Type</th>
                <th scope="col">Weight</th>
                <th scope="col">Height</th>
                <th scope="col">HP</th>
                <th scope="col">Attack</th>
                <th scope="col">Defense</th>
                <th scope="col">Is Legendary</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pokemons as $pokemon)
                <tr>
                    <th scope="row">{{ $pokemon->id }}</th>
                    <td>
                        <a href="{{ route('pokemons.show', $pokemon) }}">
                            {{ $pokemon->name }}
                        </a>
                    </td>
                    <td>{{ $pokemon->species }}</td>
                    <td>{{ $pokemon->primary_type }}</td>
                    <td>{{ $pokemon->weight }}</td>
                    <td>{{ $pokemon->height }}</td>
                    <td>{{ $pokemon->hp }}</td>
                    <td>{{ $pokemon->attack }}</td>
                    <td>{{ $pokemon->defense }}</td>
                    <td>{{ $pokemon->is_legendary ? 'Yes' : 'No' }}</td>
                    <td>
                        <a href="{{ route('pokemons.edit', $pokemon) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pokemons.destroy', $pokemon) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11">No Pokémon found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center">
    {!! $pokemons->links() !!}
</div>

@endsection
