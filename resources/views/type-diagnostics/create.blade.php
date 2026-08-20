@extends('layouts.app')

@section('title', 'Nouveau type de diagnostic')

@section('content')
    <form method="POST" action="{{ route('type-diagnostics.store') }}" class="max-w-xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @include('type-diagnostics._form')
        <x-form-actions :cancel-route="route('type-diagnostics.index')" />
    </form>
@endsection
