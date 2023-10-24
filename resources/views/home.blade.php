@extends('layouts.app')

@section('content')
    @if (auth()->user()->type == 'Administrator' || auth()->user()->type == 'Coordinator')
        <x-admin-dashboard></x-admin-dashboard>
    @endif
    @if (auth()->user()->type == 'Alumni')
        <x-alumni-dashboard></x-alumni-dashboard>
    @endif

    @if (auth()->user()->type == 'Student')
        <x-student-dashboard></x-student-dashboard>
    @endif
@endsection
