@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">
            Edit Post
        </h1>

    </div>

    <div class="bg-white p-4 mt-4 rounded border-t-4 border-t-pink-500">
        <form action="/posts/{{$post->id}}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="type" value="{{$post->type}}"/>
            <div class="flex">
                <div class="w-1/2 p-2">
                    <label for="">
                        Title
                    </label>
                    <input name="title" value="{{$post->title}}" required class="w-full border-2  mb-2 p-2 rounded-lg" type="text">
                    <label for="">
                        Attach Photo
                    </label>
                    <input type="file" required class="block" name="image" />
                </div>
                <div class="w-1/2 p-2">
                    <label for="">
                        Description
                    </label>
                    <textarea  name="description" required class="w-full border-2  mb-2 p-2 rounded-lg" type="text">{{$post->description}}</textarea>
                    <button type="submit" class="bg-pink-500 p-2 rounded-lg font-bold text-white">UPDATE</button>
                </div>
            </div>
        </form>
    </div>
@endsection
