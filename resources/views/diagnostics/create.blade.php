@extends('layouts.app')

@section('title', 'Nouveau diagnostic')

@section('content')
    <form method="POST" action="{{ route('diagnostics.store') }}" class="max-w-4xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @include('diagnostics._form')
        <x-form-actions :cancel-route="route('diagnostics.index')" />
    </form>
@endsection
