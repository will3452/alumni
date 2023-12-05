<div class="relative">
    <div class="p-4  opacity-20  rounded relative overflow-y-hidden " style="height: 70vh; background: url('/trajectory.png');   background-size: contain;background-position:center; background-repeat: no-repeat;  ">
    
    </div>
    <div class="absolute w-full top-0">
        <div class="flex items-start mt-4">
                <div class="mr-4 relative w-full md:w-1/4 shadow-xl border-2 border-pink-500 rounded bg-white">
                    <div class="relative  rounded inline-block p-2 -top-5 left-5 bg-pink-500 text-white">
                        DONATIONS
                    </div>
                    <div class="text-right text-gray-700 font-bold text-xl p-2">
                        PHP {{ \App\Models\Donation::whereNotNull('approved_at')->sum('amount') }}
                    </div>
                    <div class="text-center border-t-2 text-sm font-mono p-2">
                        {{ \Carbon\Carbon::now()->format('m/d/y')}}
                    </div>
                </div>
                <div class="mr-4 relative w-full md:w-1/4  shadow-xl border-2 border-pink-500 rounded bg-white">
                    <div class="relative  rounded inline-block p-2 -top-5 left-5 bg-pink-500 text-white">
                        POSTS
                    </div>
                    <div class="text-right text-gray-700 font-bold text-xl p-2">
                        {{\App\Models\Post::count()}}
                    </div>
                    <div class="text-center border-t-2 text-sm font-mono p-2">
                        {{ \Carbon\Carbon::now()->format('m/d/y')}}
                    </div>
                </div>
        </div>
        <div>
            <a href="">SET GOAL</a>
        </div>
    </div>
</div>