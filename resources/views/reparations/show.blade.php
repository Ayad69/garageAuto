@extends('layouts.app')

@section('title', 'Réparation')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('reparations.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Retour</a>
            <h2 class="mt-1 text-xl font-semibold">{{ $reparation->typeReparation?->libTypeReparation }} — {{ $reparation->vehicule?->immat }}</h2>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('reparations.edit', $reparation) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Modifier</a>
            <x-delete-button :action="route('reparations.destroy', $reparation)" confirm="Supprimer cette réparation ?" />
        </div>
    </div>

    <div class="mb-6 grid gap-4 rounded-xl bg-white p-6 shadow-sm sm:grid-cols-2">
        <p><span class="text-slate-500">Véhicule :</span>
            <a href="{{ route('vehicules.show', $reparation->vehicule) }}" class="text-amber-700 hover:underline">{{ $reparation->vehicule?->immat }}</a>
        </p>
        <p><span class="text-slate-500">Client :</span> {{ $reparation->vehicule?->client?->nomComplet() }}</p>
        <p><span class="text-slate-500">Début :</span> {{ $reparation->dateDebut?->format('d/m/Y') }}</p>
        <p><span class="text-slate-500">Fin :</span> {{ $reparation->dateFin?->format('d/m/Y') }}</p>
        <p><span class="text-slate-500">Statut :</span> {{ $reparation->status }}</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <h3 class="mb-3 font-medium">Mécaniciens</h3>
            @forelse ($reparation->mecaniciens as $mecanicien)
                <p class="py-1 text-sm">
                    <a href="{{ route('mecaniciens.show', $mecanicien) }}" class="text-amber-700 hover:underline">{{ $mecanicien->nomComplet() }}</a>
                    — {{ $mecanicien->pivot->dateIntervention }}
                    @if ($mecanicien->pivot->commentaire)
                        ({{ $mecanicien->pivot->commentaire }})
                    @endif
                </p>
            @empty
                <p class="text-sm text-slate-500">Aucun mécanicien.</p>
            @endforelse
        </div>
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <h3 class="mb-3 font-medium">Pièces</h3>
            @forelse ($reparation->pieces as $piece)
                <p class="py-1 text-sm">
                    <a href="{{ route('pieces.show', $piece) }}" class="text-amber-700 hover:underline">{{ $piece->nomPiece }}</a>
                    — qté {{ $piece->pivot->quantite }}
                </p>
            @empty
                <p class="text-sm text-slate-500">Aucune pièce.</p>
            @endforelse
        </div>
    </div>
@endsection
