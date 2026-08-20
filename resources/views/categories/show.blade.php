@extends('layouts.app')

@section('title', 'Catégorie')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('categories.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Retour</a>
            <h2 class="mt-1 text-xl font-semibold">{{ $categorie->libCat }}</h2>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('categories.edit', $categorie) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Modifier</a>
            <x-delete-button :action="route('categories.destroy', $categorie)" confirm="Supprimer cette catégorie ?" />
        </div>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h3 class="mb-3 font-medium">Pièces ({{ $categorie->pieces->count() }})</h3>
        @forelse ($categorie->pieces as $piece)
            <p class="py-1 text-sm">
                <a href="{{ route('pieces.show', $piece) }}" class="text-amber-700 hover:underline">{{ $piece->nomPiece }}</a>
            </p>
        @empty
            <p class="text-sm text-slate-500">Aucune pièce.</p>
        @endforelse
    </div>
@endsection
