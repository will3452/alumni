@extends('layouts.app')

@section('content')
<div class="bg-white rounded relative" style="height: 78vh; background: url('/trajectory.png') #fff; background-size: cover; ">
    <h1 class="font-bold uppercase font-mono absolute right-0 p-2 text-2xl">Career Trajectory</h1>
    <div class="text-center text-2xl font-mono font-bold p-10">
        Step {{$step->sq}}
    </div>
    <div class="flex w-full">
        <div class="w-2/3 bg-gray-100 p-4 m-4 bg-opacity-80">
            <h1 class="text-xl font-bold font-mono text-center mb-2">Step Requirements</h1>
            @foreach (explode(',', $step->requirements) as $item)
                <div class="font-mono p-2 rounded bg-white font-bold mb-2 border-dashed border-2 bg-opacity-5">
                    {{$item}}
                </div>
            @endforeach
        </div>
        <div class="w-1/3 bg-gray-100 p-4 m-4 bg-opacity-80">
            <h1 class="text-xl font-bold font-mono text-center">Step Descriptions</h1>
            <p class="font-mono italic text-gray-700 text-md">
                {{$step->descriptions}}
            </p>
        </div>
    </div>
</div>
@endsection