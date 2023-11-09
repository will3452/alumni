@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">
            Users
        </h1>
        {{-- <button class="p-2 rounded text-white font-bold bg-pink-500">
            Create User
        </button> --}}
    </div>

    <div class="bg-white p-4 mt-4 rounded border-t-4 border-t-pink-500">
        <table id="table">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        type
                    </th>
                    <th>
                        status
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->type}}
                    </td>
                    <td>
                        @if ($user->status == 'for_review')
                            FOR REVIEW
                        @endif

                        @if ($user->status == 'active')
                            ACTIVE
                        @endif

                        @if ($user->status == 'rejected')
                            BLOCKED
                        @endif
                    </td>
                    <td>
                        @if ($user->status == 'for_review')
                            <a class="p-1 uppercase bg-pink-500 rounded text-white text-sm cursor-pointer" href="/approve/{{$user->id}}">ALLOW</a>
                            <a class="p-1 uppercase bg-red-500 rounded text-white text-sm cursor-pointer"  href="/reject/{{$user->id}}">DENY</a>
                        @endif
                        @if ($user->status == 'active')
                            <a class="p-1 uppercase bg-blue-500 rounded text-white text-sm cursor-pointer" href="/alumni/profile/{{$user->id}}">VIEW</a>
                            <a class="p-1 uppercase bg-red-500 rounded text-white text-sm cursor-pointer"  href="/reject/{{$user->id}}">BLOCK</a>
                        @endif
                        @if ($user->status == 'rejected')
                            <a class="p-1 uppercase bg-pink-500 rounded text-white text-sm cursor-pointer" href="/approve/{{$user->id}}">ALLOW</a>
                        @endif
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
