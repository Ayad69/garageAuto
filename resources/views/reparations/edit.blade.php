@extends('layouts.app')

@section('title', 'Modifier la réparation')

@section('content')
    <form method="POST" action="{{ route('reparations.update', $reparation) }}" class="max-w-4xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('reparations._form')
        <x-form-actions :cancel-route="route('reparations.index')" />
    </form>
@endsection
