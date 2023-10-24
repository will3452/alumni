@extends('layouts.app')

@section('content')
    <div class="bg-white w-full rounded-xl p-4 border-2" style="height: 80vh">
        <div class="flex">
            <img src="/avatar.jpg" alt="" class="w-32 rounded-lg border-2">
            <div class="mx-2 w-1/2">
                <div class="mt-2 block p-2 border-2 rounded-lg font-bold">
                    {{ $user->name}}
                </div>
                <div class="text-xs mt-2 block p-2 border-2 rounded-lg font-bold">
                    {{ $user->course}}
                </div>
                <div class="text-xs mt-2 block p-2 border-2 rounded-lg font-bold">
                    {{ $user->school_year}}
                </div>
            </div>
        </div>
        @if (auth()->id() == $user->id)
        <form action="/save-profile" method="POST">
            @csrf
                <div>
                    <textarea name="descriptions" placeholder="Description" class="p-2 w-full border-2 mt-2 rounded-xl" name="" id="" cols="30" rows="5">{{$user->descriptions}}</textarea>
                </div>
                <div>
                    <textarea name="skills" placeholder="Skills" class="p-2 w-full border-2 mt-2 rounded-xl" name="" id="" cols="30" rows="5">{{$user->skills}}</textarea>
                </div>
                <button type="submit" class="px-4 p-2 font-bold text-white rounded-xl bg-pink-500">
                    SAVE
                </button>
           </form>
        @else
        <div>
            <div class="text-2xl font-bold mt-2">
                Description
            </div>
            <div class="font-mono">
                {{$user->descriptions ?? 'lorem ipsum dolor set.'}}
            </div>
        </div>
        <div>
            <div class="text-2xl font-bold mt-2">
                Skills
            </div>
            <div class="font-mono">
                {{$user->skills ?? 'lorem ipsum dolor set.'}}
            </div>
        </div>
        @endif

    </div>
@endsection