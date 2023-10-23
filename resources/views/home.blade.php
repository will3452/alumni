@extends('layouts.app')

@section('content')
    @if (auth()->user()->type == 'Administrator')
        <x-admin-dashboard></x-admin-dashboard>
    @endif
    @if (auth()->user()->type == 'Alumni')
        <x-alumni-dashboard></x-alumni-dashboard>
    @endif
@endsection
