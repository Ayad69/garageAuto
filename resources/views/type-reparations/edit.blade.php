@extends('layouts.app')

@section('title', 'Modifier le type de réparation')

@section('content')
    <form method="POST" action="{{ route('type-reparations.update', $typeReparation) }}" class="max-w-xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('type-reparations._form')
        <x-form-actions :cancel-route="route('type-reparations.index')" />
    </form>
@endsection
