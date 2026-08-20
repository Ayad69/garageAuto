@extends('layouts.app')

@section('title', 'Modifier le mécanicien')

@section('content')
    <form method="POST" action="{{ route('mecaniciens.update', $mecanicien) }}" class="max-w-3xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('mecaniciens._form')
        <x-form-actions :cancel-route="route('mecaniciens.index')" />
    </form>
@endsection
