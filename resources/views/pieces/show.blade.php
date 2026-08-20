@extends('layouts.app')

@section('title', 'Pièce')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('pieces.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Retour</a>
            <h2 class="mt-1 text-xl font-semibold">{{ $piece->nomPiece }}</h2>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('pieces.edit', $piece) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Modifier</a>
            <x-delete-button :action="route('pieces.destroy', $piece)" confirm="Supprimer cette pièce ?" />
        </div>
    </div>

    <div class="mb-6 grid gap-4 rounded-xl bg-white p-6 shadow-sm sm:grid-cols-2">
        <p><span class="text-slate-500">Référence :</span> {{ $piece->reference }}</p>
        <p><span class="text-slate-500">Catégorie :</span>
            <a href="{{ route('categories.show', $piece->categorie) }}" class="text-amber-700 hover:underline">{{ $piece->categorie?->libCat }}</a>
        </p>
        <p><span class="text-slate-500">Prix :</span> {{ number_format($piece->prix, 2, ',', ' ') }} €</p>
        <p><span class="text-slate-500">Stock :</span> {{ $piece->stock }}</p>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h3 class="mb-3 font-medium">Réparations ({{ $piece->reparations->count() }})</h3>
        @forelse ($piece->reparations as $reparation)
            <p class="py-1 text-sm">
                <a href="{{ route('reparations.show', $reparation) }}" class="text-amber-700 hover:underline">
                    Réparation #{{ $reparation->id }} — qté {{ $reparation->pivot->quantite }}
                </a>
            </p>
        @empty
            <p class="text-sm text-slate-500">Aucune réparation.</p>
        @endforelse
    </div>
@endsection
