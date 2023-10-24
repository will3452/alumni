@extends('layouts.app')

@section('content')
    <div style="height:80vh;" class="overflow-y-auto">
        <img class="w-64" src="{{str_replace('public', '/storage', $post->image)}}" alt="">
        <h1 class="text-2xl font-bold font-mono">{{$post->title}}</h1>
        <pre>{{$post->description}}</pre>
    </div>
@endsection
