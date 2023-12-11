@extends('layouts.app')
@section('content')
    <h1 class="text-2xl font-bold">ADD PROGRESS</h1>
    {{-- year, type (career, academic), company, school, job, level,  --}}
    <form action="/add-progress" method="POST">
        @csrf 
        <div class="flex">
            <div class="w-1/3 p-2">
                <label for="" class="block font-bold uppercase">Year</label>
                <input type="number" name="year" class="border-2 p-2 w-full">
            </div>
            <input type="hidden" name="type" value="career" />
            <div class="w-1/3 p-2">
                <label for="" class="block font-bold uppercase">Company</label>
                <input type="text" name="company" class="border-2 p-2 w-full">
            </div>
        </div>
        <div class="flex">
            <div class="w-1/3 p-2">
                <label for="" class="block font-bold uppercase mt-4">School</label>
                <input type="text" name="school" class="border-2 p-2 w-full">
            </div>
            <div class="w-1/3 p-2">
                <label for="" class="block font-bold uppercase mt-4">Job</label>
                <input type="text" name="job" class="border-2 p-2 w-full">
            </div>
            <div class="w-1/3 p-2">
                <label for="" class="block font-bold uppercase mt-4">Level</label>
                <select name="level" id="" class="border-2 p-2 w-full">
                    <option value="Junior">Junior</option>
                    <option value="Mid">Mid</option>
                    <option value="Senior">Senior</option>
                </select>
            </div>
        </div>
        <div class="p-2">
            <label for="" class="block font-bold uppercase mt-4">Salary</label>
            <input type="text" name="salary" class="border-2 p-2 w-64">
        </div>
        <button type="submit" class="p-2 rounded text-white mt-4" style="background:#800000">ADD</button>
    </form>
@endsection
