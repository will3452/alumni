@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">
            Posts
        </h1>
        @if (auth()->user()->type == 'Coordinator')
            <div>
                <a href="/posts/job"  class="border-2 border-pink-500 bg-white p-2 rounded-xl text-pink-500 font-bold">Create Job post</a>
                <a href="/posts/news"  class="border-2 border-pink-500 bg-white p-2 rounded-xl text-pink-500 font-bold">Create New & Events</a>
            </div>
        @endif
    </div>

    @forelse ($posts as $item)
        <div class="flex bg-white p-4 mt-4 rounded border-t-4 border-t-pink-500">
            <img class="w-64" src="{{str_replace('public', '/storage', $item->image)}}" alt="">
            <div class="px-4 w-2/3">
                <div class="text-lg font-bold uppercase bg-red-200 px-4 rounded inline-block">{{$item->type}}</div>
                <h1 class="text-lg">Title: {{$item->title}}</h1>
                <h2 class="border-2 p-2 my-4">Descriptions: {{$item->description }}</h2>
                @if ($item->user_id == auth()->id())
                    <a href="/posts/edit/{{$item->id}}" class="underline text-red-900 font-bold mx-4">Edit Post</a> 
                    <a href="/posts/delete-confirm/{{$item->id}}" class="underline text-red-600 font-bold mx-4">Delete Post</a>
                @endif
            </div>
        </div>
    @empty
        <div class="text-center text-xl">
            No Post available.
        </div>
    @endforelse
@endsection
