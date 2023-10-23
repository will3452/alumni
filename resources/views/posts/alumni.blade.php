@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center">
        <h1 class="text-2xl font-bold">
            Latest Feeds
        </h1>
    </div>

   <div class="flex">
    <div class="w-full md:w-1/2 p-2">
        <h1 class="text-center font-bold text-xl">Jobs</h1>
        @forelse (\App\Models\Post::whereType('JOB')->latest()->get() as $item)
        <div class="flex bg-white p-4 mt-4 rounded border-t-4 border-t-pink-500">
            <img class="w-64" src="{{str_replace('public', '/storage', $item->image)}}" alt="">
            <div class="px-4 w-2/3">
                <h1 class="text-lg">Title: {{$item->title}}</h1>
                <h2 class="border-2 p-2 my-4">Descriptions: {{$item->description }}</h2>
            </div>
        </div>
    @empty
        <div class="text-center text-xl">
            No Post available.
        </div>
    @endforelse
    </div>
    <div class="w-full md:w-1/2 p-2">
        <h1 class="text-center font-bold text-xl">NEWS & EVENTS</h1>
        @forelse (\App\Models\Post::whereType('NEWS/EVENTS')->latest()->get() as $item)
        <div class="flex bg-white p-4 mt-4 rounded border-t-4 border-t-pink-500">
            <img class="w-64" src="{{str_replace('public', '/storage', $item->image)}}" alt="">
            <div class="px-4 w-2/3">
                <h1 class="text-lg">Title: {{$item->title}}</h1>
                <h2 class="border-2 p-2 my-4">Descriptions: {{$item->description }}</h2>
            </div>
        </div>
    @empty
        <div class="text-center text-xl">
            No Post available.
        </div>
    @endforelse
    </div>
   </div>
@endsection
