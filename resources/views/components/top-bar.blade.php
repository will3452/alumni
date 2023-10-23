<div class="flex items-center justify-between p-4  m-4 border-2 rounded-xl bg-white">
    <div class="flex items-center">
        <img src="" alt="" class="w-8 h-8 bg-black rounded-full" />
        @auth
            <div>
                <h1 class="uppercase mx-2 text-sm font-bold text-gray-400">{{ auth()->user()->name}}</h1>
                <div class="mx-2 font-bold">
                    <small>
                        {{auth()->user()->type}}
                    </small>
                </div>
            </div>
        @endauth
    </div>
    <div class="text-gray-700">
        {{-- {{ \Carbon\Carbon::now()->format('m/d/y') }} --}}
        <a href="/logout" class="p-2 bg-pink-500 rounded-xl text-white font-bold">LOGOUT</a>
    </div>
</div>