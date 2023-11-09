@extends('layouts.app')

@section('content')
    <div style="height:80vh;" class="overflow-y-auto">
       <div class="text-2xl mb-2">
        Deleting a record that is related to or used by another record can cause data issues. Are you sure you want to delete the course <span class="font-bold">"{{$course->name}}"</span>? 
       </div>
        <form action="/courses/{{$course->id}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="bg-red-500 text-white px-2 rounded">YES, PROCEED.</button>
            <a href="{{url()->previous()}}" class="bg-gray-200 px-2 rounded">CANCEL</a>
        </form>
    </div>
@endsection
