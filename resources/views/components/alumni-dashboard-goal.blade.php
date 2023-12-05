<div class="relative">
    <div class="p-4  opacity-10  rounded relative overflow-y-hidden " style="height: 70vh; background: url('/trajectory.png');   background-size: contain;background-position:center; background-repeat: no-repeat;  ">
    
    </div>
    <div class="p-4  rounded absolute overflow-y-hidden w-full top-0" style="height: 80vh; background-size: cover; ">
        <a href="/home" class="font-bold">BACK TO HOME</a>
        @if (auth()->user()->goals()->count() == 0)
        <form action="/set-goal" method="POST" x-data='{courseId: "", courses:{!!\App\Models\Course::get()!!}  }' class="mt-4 p-4  rounded-lg bg-white bg-opacity-90 shadow-xl border-gray-500 inline-block w-full md:w-1/2">
             @csrf
                 <select name="course_id" id="" class="w-full rounded border-2 p-2" x-on:change="(e) => courseId = e.target.value">
                     <option value="" selected disabled class="bg-gray-200">SELECT GOAL</option>
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
</div>
