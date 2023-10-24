<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
</head>
<body class="bg-gray-200">
    @include('sweetalert::alert')
    <div class="flex">
        @if (auth()->user()->type == 'Administrator')
            <x-admin-sidebar></x-admin-sidebar>
        @endif

        @if (auth()->user()->type == 'Alumni')
            <x-alumni-sidebar></x-alumni-sidebar>
        @endif

        @if (auth()->user()->type == 'Coordinator')
            <x-coordinator-sidebar></x-coordinator-sidebar>
        @endif

        @if (auth()->user()->type == 'Student')
            <x-student-sidebar></x-student-sidebar>
        @endif

        <div class="w-3/4">
            <x-top-bar></x-top-bar>

            <div class="p-4">
                @foreach ($errors->all() as $error)
                <div>
                    <small class="text-red-700 uppercase font-bold">{{$error}}</small>
                </div>
                @endforeach
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>