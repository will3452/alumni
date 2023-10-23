@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">
            Donations
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
                        Accounts
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
                        <a href="{{route('admin.donation.show', ['user' => $user])}}" class="p-1 uppercase bg-blue-500 rounded text-white text-sm cursor-pointer">View Donations</a>
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
