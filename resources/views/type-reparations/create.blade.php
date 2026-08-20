@extends('layouts.app')

@section('title', 'Nouveau type de réparation')

@section('content')
    <form method="POST" action="{{ route('type-reparations.store') }}" class="max-w-xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @include('type-reparations._form')
        <x-form-actions :cancel-route="route('type-reparations.index')" />
    </form>
@endsection
