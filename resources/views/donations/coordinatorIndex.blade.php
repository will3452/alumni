@extends('layouts.app')

@section('content')
    <div class="flex items-start justify-between">
        <div class="relative w-full md:w-1/4 shadow-xl border-2 border-pink-500 rounded">
            <div class="relative  rounded inline-block p-2 -top-5 left-5 bg-pink-500 text-white">
                Total Donations
            </div>
            <div class="text-right text-gray-700 font-bold text-xl p-2">
                PHP {{ \App\Models\Donation::whereNotNull('approved_at')->sum('amount') }}
            </div>
            <div class="text-center border-t-2 text-sm font-mono p-2">
                {{ \Carbon\Carbon::now()->format('m/d/y')}}
            </div>
        </div>
        <div>
            <h2 class="font-bold">
                Recent Donators
            </h2>
            @foreach ($latestDonations as $item)
                <div class=" text-sm border-2 p-2 border-gray-500 rounded mb-2">
                    {{$item->user->name}} - PHP {{$item->amount}}
                </div>
            @endforeach
        </div>
    </div>

    <h1 class="mt-10 mb-5 text-2xl font-bold" >Donation List</h1>
    <div class="bg-white p-4 mt-4 rounded border-t-4 border-t-pink-500">
        <table id="table">
            <thead>
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Descriptions
                    </th>
                    <th>
                        Amount
                    </th>
                    <th>
                        Mode Of Payment
                    </th>
                    <th>
                        Proof
                    </th>
                    <th>
                        Approved Date
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donations as $d)
                <tr>
                    <td>
                        {{$d->user->name}}
                    </td>
                    <td>
                        {{$d->created_at}}
                    </td>
                    <td>
                        {{$d->description}}
                    </td>
                    <td>
                        {{$d->amount}}
                    </td>
                    <td>
                        {{$d->mop}}
                    </td>
                    <td>
                        <a target="_blank" href="{{str_replace('public', '/storage', $d->receipt)}}" class="text-xs font-blue-500">
                            Click here to view proof
                        </a>
                    </td>
                    <td>
                        {{$d->approved_at ?? '--'}}
                    </td>
                    <td>
                        @if ($d->approved_at == null)
                        <a href="{{route('coor.approve', ['donation' => $d])}}" class="text-white bg-pink-500 p-2 rounded text-xs">APPROVE</a>
                        @else
                        <i class="text-xs">APPROVED</i>
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
