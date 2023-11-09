<div class="absolute justify-start flex w-full bottom-0 items-end">
    @foreach (\App\Models\UserCourse::whereUserId(auth()->id())->first()->course->steps as $index => $item)
        <div style="min-width:200px; height: {{100 * ($index + 1)}}px;" class="bg-opacity-90 bg-white border-4 border-gray-500 rounded-tr-xl rounded-tl-xl relative">
            @if (auth()->user()->isDone($item->id))
                <img src="/star.gif" alt="" class="w-14 left-16 absolute -top-14">
            @endif
            <h1 class="text-center font-bold uppercase my-4">
                Step {{$item->sq}}
            </h1>
            <div class="flex justify-center items-center">
                <a class="mx-2 bg-white shadow-xl border-2 p-1 px-2 font-bold rounded-xl" href="/courses/step/{{$item->id}}">
                    View
                </a>
                <a class="mx-2 bg-white shadow-xl border-2 p-1 px-2 font-bold rounded-xl" href="/done/{{$item->id}}">
                    Done
                </a>
            </div>
            <div class="bg-gray-800 m-4 rounded-xl" style=" height: 90%" ></div>
        </div>
    @endforeach
</div>