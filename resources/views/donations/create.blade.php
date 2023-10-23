@extends('layouts.app')

@section('content')
    <h1 class=" mb-5 text-2xl font-bold" >Create Donation</h1>
    <form enctype="multipart/form-data" class="border-2 p-4 bg-white rounded-lg" method="POST" action="{{route('alumni.donations.store')}}">
        @csrf
        <div class="flex">
            <div class="w-full md:w-2/3">
                <label for="" class="">Name</label>
                <input type="text" value="{{auth()->user()->name}}" class="w-full border-2  mb-2 p-2 rounded-lg" disabled>
                <label for="" class="">Mode of payment</label>
                <select type="text" name="mop" required class="w-full border-2  mb-2 p-2 rounded-lg">
                    <option value="Over the counter">Over the counter</option>
                    <option value="gcash">Gcash</option>
                    <option value="bank">Bank</option>
                </select>
                <label for="" class="">Amount (PHP)</label>
                <input type="number" required name="amount" class="w-full border-2  mb-2 p-2 rounded-lg">
            </div>
            <div class="w-full md:w-1/3 p-2">
                <label for="" class="">Descriptions </label>
                <textarea  required class="w-full border-2  mb-2 p-2 rounded-lg" placeholder="Aa" name="description" id=""></textarea>
                <label for="">Upload Proof of payment</label>
                <input name="receipt" type="file">
            </div>
        </div>
        <button type="submit" class="bg-pink-500 p-2 text-white font-bold rounded-lg">DONATE</button>
    </form>
@endsection
