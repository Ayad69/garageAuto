@extends('layouts.app')

@section('title', 'Diagnostics')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-500">{{ $diagnostics->total() }} diagnostic(s)</p>
        <a href="{{ route('diagnostics.create') }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Ajouter</a>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="px-4 py-3 font-medium">Véhicule</th>
                    <th class="px-4 py-3 font-medium">Type</th>
                    <th class="px-4 py-3 font-medium">Début</th>
                    <th class="px-4 py-3 font-medium">Fin</th>
                    <th class="px-4 py-3 font-medium">Statut</th>
                    <th class="px-4 py-3 text-right font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($diagnostics as $diagnostic)
                    <tr>
                        <td class="px-4 py-3">{{ $diagnostic->vehicule?->immat }}</td>
                        <td class="px-4 py-3">{{ $diagnostic->typeDiagnostic?->libTypeDiagnostic }}</td>
                        <td class="px-4 py-3">{{ $diagnostic->dateDebut?->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $diagnostic->dateFin?->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $diagnostic->status }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('diagnostics.show', $diagnostic) }}" class="font-medium text-slate-600 hover:text-slate-900">Voir</a>
                            <a href="{{ route('diagnostics.edit', $diagnostic) }}" class="font-medium text-amber-600 hover:text-amber-800">Modifier</a>
                            <x-delete-button :action="route('diagnostics.destroy', $diagnostic)" confirm="Supprimer ce diagnostic ?" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-500">Aucun diagnostic.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $diagnostics->links() }}</div>
@endsection
