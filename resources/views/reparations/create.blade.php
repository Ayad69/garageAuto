@extends('layouts.app')

@section('title', 'Nouvelle réparation')

@section('content')
    <form method="POST" action="{{ route('reparations.store') }}" class="max-w-4xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @include('reparations._form')
        <x-form-actions :cancel-route="route('reparations.index')" />
    </form>
@endsection
