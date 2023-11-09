<div class="p-4 bg-white rounded relative overflow-y-hidden" style="height: 90vh; background: url('/trajectory.png') #fff; background-size: cover; ">
    <h1 class="font-bold uppercase font-mono absolute right-0 p-2 text-2xl">Career Trajectory</h1>
    <div class="flex items-start mt-4">
            <div class="mr-4 relative w-full md:w-1/4 shadow-xl border-2 border-pink-500 rounded bg-white">
                <div class="relative  rounded inline-block p-2 -top-5 left-5 bg-pink-500 text-white">
                    DONATIONS
                </div>
                <div class="text-right text-gray-700 font-bold text-xl p-2">
                    PHP {{ \App\Models\Donation::whereNotNull('approved_at')->sum('amount') }}
                </div>
                <div class="text-center border-t-2 text-sm font-mono p-2">
                    {{ \Carbon\Carbon::now()->format('m/d/y')}}
                </div>
            </div>
            <div class="relative w-full md:w-1/4 shadow-xl border-2 border-pink-500 rounded bg-white">
                <div class="relative  rounded inline-block p-2 -top-5 left-5 bg-pink-500 text-white">
                    POSTS
                </div>
                <div class="text-right text-gray-700 font-bold text-xl p-2">
                    {{\App\Models\Post::count()}}
                </div>
                <div class="text-center border-t-2 text-sm font-mono p-2">
                    {{ \Carbon\Carbon::now()->format('m/d/y')}}
                </div>
            </div>
       </div>
       @if (auth()->user()->goals()->count() == 0)
       <form action="/set-goal" method="POST" x-data='{courseId: "", courses:{!!\App\Models\Course::get()!!}  }' class="mt-4 p-4  rounded-lg bg-white bg-opacity-90 border-2 border-gray-500 inline-block w-full md:w-1/2">
            @csrf
                <select name="course_id" id="" class="w-full rounded border-2 p-2" x-on:change="(e) => courseId = e.target.value">
                    <option value="" selected disabled class="bg-gray-200">SELECT COURSE</option>
                    @foreach (\App\Models\Course::get() as $course)
                        <option value="{{$course->id}}">
                            {{$course->name}}
                        </option>
                    @endforeach
                </select>
                <div class="mt-4 font-bold">
                    Description: 
                </div>
                <div x-if="courseId" x-text="courses.find(e => e.id == courseId).descriptions"></div>
                <div>

                </div>
                <div class="text-right">
                    <button class="font-bold p-2 rounded-xl border-2 bg-red-900 text-white mt-4">SET GOAL</button>
                </div>
        </form>
        @else 
        <x-alumni-steps></x-alumni-steps>
       @endif
</div>