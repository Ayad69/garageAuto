@extends('layouts.app')

@section('title', 'Nouveau mécanicien')

@section('content')
    <form method="POST" action="{{ route('mecaniciens.store') }}" class="max-w-3xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @include('mecaniciens._form')
        <x-form-actions :cancel-route="route('mecaniciens.index')" />
    </form>
@endsection
