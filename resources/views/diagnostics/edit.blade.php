@extends('layouts.app')

@section('title', 'Modifier le diagnostic')

@section('content')
    <form method="POST" action="{{ route('diagnostics.update', $diagnostic) }}" class="max-w-4xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('diagnostics._form')
        <x-form-actions :cancel-route="route('diagnostics.index')" />
    </form>
@endsection
