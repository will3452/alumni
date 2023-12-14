<div class="bg-white border-2 rounded p-4 pt-8 overflow-scroll" style="height:80vh;">
    <div class="flex">
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
      <div class="ml-2 relative w-full md:w-3/4 shadow-xl border-2 border-pink-500 rounded">
        <div class="relative  rounded inline-block p-2 -top-5 left-5 bg-pink-500 text-white">
            Downloable Reports
        </div>
        <br>
        <div class="p-2 flex">
          <a href="/exports?type=USER" class="bg-white block px-2 py-1 text-red-900  rounded-xl shadow-xl flex border-2 mx-4 font-bold items-center text-sm"> <img class="w-8" src="/download.gif" alt=""> User Masterlist</a>
          <a href="/exports?type=DONATION" class="bg-white block px-2 py-1 text-red-900  rounded-xl shadow-xl flex border-2 mx-4 font-bold items-center text-sm"> <img class="w-8" src="/download.gif" alt=""> Donations</a>
          <a href="/exports?type=COURSE" class="bg-white block px-2 py-1 text-red-900  rounded-xl shadow-xl flex border-2 mx-4 font-bold items-center text-sm"> <img class="w-8" src="/download.gif" alt=""> Course Masterlist</a>
          <a href="/exports?type=ALUMNI" class="bg-white block px-2 py-1 text-red-900  rounded-xl shadow-xl flex border-2 mx-4 font-bold items-center text-sm"> <img class="w-8" src="/download.gif" alt=""> Alumni Data</a>
        </div>
    </div>
    </div>
    <div class="mt-4"></div>
    <x-chart></x-chart>
</div>
