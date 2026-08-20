@extends('layouts.app')

@section('title', 'Pièces')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-500">{{ $pieces->total() }} pièce(s)</p>
        <a href="{{ route('pieces.create') }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Ajouter</a>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="px-4 py-3 font-medium">Nom</th>
                    <th class="px-4 py-3 font-medium">Référence</th>
                    <th class="px-4 py-3 font-medium">Catégorie</th>
                    <th class="px-4 py-3 font-medium">Prix</th>
                    <th class="px-4 py-3 font-medium">Stock</th>
                    <th class="px-4 py-3 text-right font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($pieces as $piece)
                    <tr>
                        <td class="px-4 py-3">{{ $piece->nomPiece }}</td>
                        <td class="px-4 py-3">{{ $piece->reference }}</td>
                        <td class="px-4 py-3">{{ $piece->categorie?->libCat }}</td>
                        <td class="px-4 py-3">{{ number_format($piece->prix, 2, ',', ' ') }} €</td>
                        <td class="px-4 py-3">{{ $piece->stock }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('pieces.show', $piece) }}" class="font-medium text-slate-600 hover:text-slate-900">Voir</a>
                            <a href="{{ route('pieces.edit', $piece) }}" class="font-medium text-amber-600 hover:text-amber-800">Modifier</a>
                            <x-delete-button :action="route('pieces.destroy', $piece)" confirm="Supprimer cette pièce ?" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-500">Aucune pièce.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $pieces->links() }}</div>
@endsection
