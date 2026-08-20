@extends('layouts.app')

@section('title', 'Véhicules')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-500">{{ $vehicules->total() }} véhicule(s)</p>
        <a href="{{ route('vehicules.create') }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Ajouter</a>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="px-4 py-3 font-medium">Immat.</th>
                    <th class="px-4 py-3 font-medium">Modèle</th>
                    <th class="px-4 py-3 font-medium">Marque</th>
                    <th class="px-4 py-3 font-medium">Client</th>
                    <th class="px-4 py-3 font-medium">Km</th>
                    <th class="px-4 py-3 text-right font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($vehicules as $vehicule)
                    <tr>
                        <td class="px-4 py-3">{{ $vehicule->immat }}</td>
                        <td class="px-4 py-3">{{ $vehicule->modele }} ({{ $vehicule->annee }})</td>
                        <td class="px-4 py-3">{{ $vehicule->marque?->libMarque }}</td>
                        <td class="px-4 py-3">{{ $vehicule->client?->nomComplet() }}</td>
                        <td class="px-4 py-3">{{ number_format($vehicule->kilometrage, 0, ',', ' ') }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('vehicules.show', $vehicule) }}" class="font-medium text-slate-600 hover:text-slate-900">Voir</a>
                            <a href="{{ route('vehicules.edit', $vehicule) }}" class="font-medium text-amber-600 hover:text-amber-800">Modifier</a>
                            <x-delete-button :action="route('vehicules.destroy', $vehicule)" confirm="Supprimer ce véhicule ?" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-500">Aucun véhicule.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $vehicules->links() }}</div>
@endsection
