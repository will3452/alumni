@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">
            New Course
        </h1>
    </div>

    <form action="/courses/" method="POST" class="bg-white p-4 mt-4 rounded border-t-4 border-t-pink-500">
        @csrf
        <label for="" class="">Course Name</label>
        <input type="text" required name="name" class="w-full border-2  mb-2 p-2 rounded-lg">
        <label for="" class="">Description</label>
        <input type="text" required name="descriptions" class="w-full border-2  mb-2 p-2 rounded-lg">
        <button class="p-2 rounded text-white font-bold bg-pink-500">
            SUBMIT
        </button>
    </form>

@endsection
