@extends('layouts.app')

@section('title', 'Types de réparations')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-500">{{ $typeReparations->total() }} type(s)</p>
        <a href="{{ route('type-reparations.create') }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Ajouter</a>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="px-4 py-3 font-medium">Libellé</th>
                    <th class="px-4 py-3 text-right font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($typeReparations as $typeReparation)
                    <tr>
                        <td class="px-4 py-3">{{ $typeReparation->libTypeReparation }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('type-reparations.show', $typeReparation) }}" class="font-medium text-slate-600 hover:text-slate-900">Voir</a>
                            <a href="{{ route('type-reparations.edit', $typeReparation) }}" class="font-medium text-amber-600 hover:text-amber-800">Modifier</a>
                            <x-delete-button :action="route('type-reparations.destroy', $typeReparation)" confirm="Supprimer ce type ?" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-4 py-8 text-center text-slate-500">Aucun type de réparation.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $typeReparations->links() }}</div>
@endsection
