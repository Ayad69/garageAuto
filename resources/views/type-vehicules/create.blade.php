@extends('layouts.app')

@section('title', 'Nouveau type de véhicule')

@section('content')
    <form method="POST" action="{{ route('type-vehicules.store') }}" class="max-w-xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @include('type-vehicules._form')
        <x-form-actions :cancel-route="route('type-vehicules.index')" />
    </form>
@endsection
