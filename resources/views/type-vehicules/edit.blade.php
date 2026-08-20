@extends('layouts.app')

@section('title', 'Modifier le type de véhicule')

@section('content')
    <form method="POST" action="{{ route('type-vehicules.update', $typeVehicule) }}" class="max-w-xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('type-vehicules._form')
        <x-form-actions :cancel-route="route('type-vehicules.index')" />
    </form>
@endsection
