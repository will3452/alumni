@extends('layouts.app')

@section('content')
<div class="bg-white rounded relative" style="height: 78vh; background: url('/trajectory.png') #fff; background-size: cover; ">
    @if (! auth()->user()->hasSubmittedRequirements($step->id))
        <form action="/submit-user-step" enctype="multipart/form-data" method="POST" class="font-bold uppercase font-mono absolute right-0 p-2">
            @csrf
            <input type="hidden" name="user_id" value="{{auth()->id()}}" />
            <input type="hidden" name="step_id" value="{{$step->id}}"/>
            <input type="file" name="file" accept="image/*"> <button class="p-2 bg-pink-500 text-white rounded">SUBMIT</button>
        </form>
    @else 
        <div  class="font-bold uppercase text-gray-500 font-mono absolute right-0 p-2">
            You have already submitted the requirements.
        </div>
    @endif
    <div class="text-center text-2xl font-mono font-bold p-10">
        Step {{$step->sq}}
    </div>
    <div class="flex justify-between">
        <a href="/home" class="p-2 border-2 rounded-xl shadow-lg ml-4 text-xl"> <span class="font-bold">&lt; </span>BACK</a>
        <a href="/done/{{$step->id}}" class="p-2 border-2 rounded-xl shadow-lg mr-4 text-xl"> <span class="font-bold"> </span>MARK AS DONE</a>
    </div>
    <div class="flex w-full">
        <div class="w-2/3 bg-gray-100 p-4 m-4 ">
            <h1 class="text-xl font-bold font-mono text-center mb-2">Step Requirements</h1>
            @foreach (explode(',', $step->requirements) as $item)
                <div class="font-mono p-2 rounded bg-white font-bold mb-2 border-dashed border-2 bg-opacity-5">
                    {{$item}}
                </div>
            @endforeach
        </div>
        <div class="w-1/3 bg-gray-100 m-4 bg-opacity-80">
            <div class="p-4">
                <h1 class="text-xl font-bold font-mono text-center">Step Descriptions</h1>
                <p class="font-mono italic text-gray-700 text-md">
                    {{$step->descriptions}}
                </p>
            </div>
            <div class="p-4 bg-green-400">
                <h1 class="text-xl font-bold font-mono text-center">Career Recommendation</h1>
                @if (auth()->user()->hasSubmittedRequirements($step->id) && auth()->user()->hasApprovedRequirements($step->id))
                    <p class="font-mono italic text-gray-700 text-md">
                        @foreach (explode(',', $step->jobs) as $item)
                            <div class="font-mono p-2 rounded bg-white font-bold mb-2 border-dashed border-2 bg-opacity-5">
                                {{$item}}
                            </div>
                        @endforeach
                    </p>
                @else 
                    <div class="text-green-900">
                        This information will only be available when an attachment has been submitted and approved by the administrator.
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection