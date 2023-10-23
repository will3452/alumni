@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="text-xl font-bold">
            {{ $user->name }}'s Donations.
        </h1>
        {{-- <button class="p-2 rounded text-white font-bold bg-pink-500">
            Create User
        </button> --}}
        <a href="{{url()->previous()}}" class="text-underlined text-blue-600">Back</a>
    </div>


    <div class="bg-white p-4 mt-4 rounded border-t-4 border-t-pink-500">
        <table id="table">
            <thead>
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        Amount
                    </th>
                    <th>
                        Approved Date
                    </th>
            </tr>
            </thead>
            <tbody>
                @foreach ($user->donations as $donation)
                <tr>
                    <td>
                        {{$donation->created_at}}
                    </td>
                    <td>
                        {{$donation->amount}}
                    </td>
                    <td>
                        {{$donation->approved_at ?? '--'}}
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
