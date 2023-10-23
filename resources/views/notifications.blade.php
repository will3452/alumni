@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">
            Notifications
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
                        Messages
                    </th>
                    <th>
                        Date
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach (auth()->user()->notifications as $n)
                <tr>
                    <td>
                        {{$n->data['message']}}
                    </td>
                    <td>
                        {{$n->created_at}}
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
