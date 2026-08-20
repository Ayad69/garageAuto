@extends('layouts.app')

@section('title', 'Modifier le véhicule')

@section('content')
    <form method="POST" action="{{ route('vehicules.update', $vehicule) }}" class="max-w-3xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('vehicules._form')
        <x-form-actions :cancel-route="route('vehicules.index')" />
    </form>
@endsection
