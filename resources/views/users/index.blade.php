@extends('layouts.app')

@section('title', 'Utilisateurs')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-500">{{ $users->total() }} utilisateur(s)</p>
        <a href="{{ route('users.create') }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Ajouter</a>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="px-4 py-3 font-medium">Nom</th>
                    <th class="px-4 py-3 font-medium">Email</th>
                    <th class="px-4 py-3 font-medium">Rôle</th>
                    <th class="px-4 py-3 font-medium">Entreprise</th>
                    <th class="px-4 py-3 text-right font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($users as $user)
                    <tr>
                        <td class="px-4 py-3">{{ $user->name }} {{ $user->surname }}</td>
                        <td class="px-4 py-3">{{ $user->email }}</td>
                        <td class="px-4 py-3">{{ $user->role?->libRole }}</td>
                        <td class="px-4 py-3">{{ $user->entreprise?->nomEntreprise }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('users.show', $user) }}" class="font-medium text-slate-600 hover:text-slate-900">Voir</a>
                            <a href="{{ route('users.edit', $user) }}" class="font-medium text-amber-600 hover:text-amber-800">Modifier</a>
                            <x-delete-button :action="route('users.destroy', $user)" confirm="Supprimer cet utilisateur ?" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">Aucun utilisateur.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $users->links() }}</div>
@endsection
