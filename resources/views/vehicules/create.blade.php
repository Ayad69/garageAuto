@extends('layouts.app')

@section('title', 'Nouveau véhicule')

@section('content')
    <form method="POST" action="{{ route('vehicules.store') }}" class="max-w-3xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @include('vehicules._form')
        <x-form-actions :cancel-route="route('vehicules.index')" />
    </form>
@endsection
