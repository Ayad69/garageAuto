@extends('layouts.app')

@section('title', 'Nouvelle marque')

@section('content')
    <form method="POST" action="{{ route('marques.store') }}" class="max-w-xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @include('marques._form')
        <x-form-actions :cancel-route="route('marques.index')" />
    </form>
@endsection
