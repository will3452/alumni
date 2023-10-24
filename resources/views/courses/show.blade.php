@extends('layouts.app')

@section('content')
    <div style="height: 80vh;" class=" overflow-y-auto">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">
                Course Details
            </h1>
        </div>
        <div class="bg-white p-4 mt-4 rounded border-t-4 border-t-pink-500">
            <table>
                <tr><th class="text-left">Course Name:</th> <td>{{$course->name}}</td></tr>
                <tr><th class="text-left">Course Description:</th> <td>{{$course->descriptions}}</td></tr>
            </table>
        </div>

        <div class="bg-white p-4 mt-4 rounded border-t-4 border-t-pink-500">
            <h2 class="text-xl font-bold mb-2">Add new step</h2>
            <form action="/courses/step" method="POST">
                @csrf
                <input type="hidden" name="course_id" value="{{$course->id}}"/>
                <div class="flex">
                    <div class="w-2/3">
                        <label for="" class="block font-bold mt-4 mb-2">Sequence</label>
                        <input type="number" value="{{count($course->steps) + 1}}" required name="sq" class="w-full border-2  mb-2 p-2 rounded-lg">
                        <label for="" class="block font-bold mt-4 mb-2">Requirements</label>
                        <input type="text" required name="requirements" placeholder="Separated by comma (,) eg., Learn algebra, Learn Programming, Start a project." class="w-full border-2  mb-2 p-2 rounded-lg">
                    </div>
                    <div class="w-1/3 px-2">
                        <label for="" class="block font-bold mt-4 mb-2">Description</label>
                        <textarea required name="descriptions" class="w-full border-2 rounded h-32 p-2" placeholder="Aa"></textarea>
                    </div>
                </div>
                <button type="submit" class="p-2 bg-pink-500 text-white rounded font-bold mt-2">
                    SUBMIT
                </button>
            </form>
        </div>

        <div class="bg-white p-4 mt-4 rounded border-t-4 border-t-pink-500">
            <h2 class="text-xl font-bold mb-2">List of steps</h2>
            <table id="table">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Requirements
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($course->steps as $step)
                    <tr>
                        <td>
                            {{$step->sq}}
                        </td>
                        <td>
                            {{$step->descriptions}}
                        </td>
                        <td>
                            {{$step->requirements}}
                        </td>
                        <td>
                            <a href="/courses/remove-step/{{$step->id}}" class="bg-pink-500 p-1 px-2 rounded text-white uppercase">
                                Remove
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        let table = new DataTable('#table', {
            // options
        });
    </script>
@endsection
