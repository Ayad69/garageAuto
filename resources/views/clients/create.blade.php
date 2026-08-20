@extends('layouts.app')

@section('title', 'Nouveau client')

@section('content')
    <form method="POST" action="{{ route('clients.store') }}" class="max-w-3xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf

        <div>
            <label for="user_id" class="mb-1 block text-sm font-medium text-slate-700">Utilisateur</label>
            <select
                id="user_id"
                name="user_id"
                required
                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm shadow-sm focus:border-amber-500 focus:outline-none focus:ring-1 focus:ring-amber-500"
            >
                <option value="">Sélectionner…</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                        {{ $user->nomComplet() }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        @include('clients._form')
        <x-form-actions :cancel-route="route('clients.index')" />
    </form>
@endsection
