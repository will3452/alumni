@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">
            Courses
        </h1>
        <a href="/courses/create" class="border-2 border-pink-500 bg-white p-2 rounded-xl text-pink-500 font-bold">
            Register new Course
        </a>
    </div>

    <div class="bg-white p-4 mt-4 rounded border-t-4 border-t-pink-500">
        <table id="table">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                <tr>
                    <td>
                        {{$course->name}}
                    </td>
                    <td>
                        <a href="/courses/{{$course->id}}" class="bg-blue-500 mx-2 text-sm p-1 rounded text-white uppercase">
                            VIEW
                        </a>
                        <a href="/courses/edit/{{$course->id}}" class="bg-red-900 mx-2 text-sm p-1 rounded text-white uppercase">
                            EDIT
                        </a>
                        <a href="/courses/delete-confirm/{{$course->id}}" class="bg-red-500 mx-2 text-sm p-1 rounded text-white uppercase">
                            DELETE
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        let table = new DataTable('#table', {
            // options
        });
    </script>
@endsection
