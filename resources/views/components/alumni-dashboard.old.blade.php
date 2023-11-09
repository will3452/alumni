<div class="absolute justify-center flex w-full bottom-0 items-end">
    @foreach (\App\Models\UserCourse::whereUserId(auth()->id())->first()->course->steps as $index => $item)
        <div style="min-width:200px; height: {{85 * ($index + 1)}}px;" class="mx-1 bg-opacity-80 bg-red-{{($index + 1) * 100}} p-2 border-t-4 border-red-{{($index + 1) * 100}}">
            <h1 class="text-center font-bold uppercase mb-2">
                Step {{$item->sq}}
            </h1>
            <div class="flex justify-center items-center">
                <a class="mx-2 bg-pink-500 p-1 px-2 text-white font-bold rounded" href="/courses/step/{{$item->id}}">
                    View
                </a>
                <a class="mx-2 bg-green-500 p-1 px-2 text-white font-bold rounded" href="/courses/step/{{$item->id}}">
                    Done
                </a>
            </div>
        </div>
    @endforeach
</div>