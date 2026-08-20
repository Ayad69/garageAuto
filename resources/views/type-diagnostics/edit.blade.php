@extends('layouts.app')

@section('title', 'Modifier le type de diagnostic')

@section('content')
    <form method="POST" action="{{ route('type-diagnostics.update', $typeDiagnostic) }}" class="max-w-xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('type-diagnostics._form')
        <x-form-actions :cancel-route="route('type-diagnostics.index')" />
    </form>
@endsection
