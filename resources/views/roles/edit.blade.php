@extends('layouts.app')

@section('title', 'Modifier le rôle')

@section('content')
    <form method="POST" action="{{ route('roles.update', $role) }}" class="max-w-xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('roles._form')
        <x-form-actions :cancel-route="route('roles.index')" />
    </form>
@endsection
