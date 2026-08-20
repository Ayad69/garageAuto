@extends('layouts.app')

@section('title', 'Nouveau rôle')

@section('content')
    <form method="POST" action="{{ route('roles.store') }}" class="max-w-xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @include('roles._form')
        <x-form-actions :cancel-route="route('roles.index')" />
    </form>
@endsection
