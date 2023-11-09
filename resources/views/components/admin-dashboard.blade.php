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
            Downlable Reports
        </div>
        <br>
        <div class="p-2 flex">
          <a href="/exports?type=USER" class="bg-white block px-2 py-1 text-red-900  rounded-xl shadow-xl flex border-2 mx-4 font-bold items-center"> <img class="w-8" src="/download.gif" alt=""> User Masterlist</a>
          <a href="/exports?type=DONATION" class="bg-white block px-2 py-1 text-red-900  rounded-xl shadow-xl flex border-2 mx-4 font-bold items-center"> <img class="w-8" src="/download.gif" alt=""> Donations</a>
          <a href="/exports?type=COURSE" class="bg-white block px-2 py-1 text-red-900  rounded-xl shadow-xl flex border-2 mx-4 font-bold items-center"> <img class="w-8" src="/download.gif" alt=""> Course Masterlist</a>
        </div>
    </div>
    </div>
    
    <div class="w-full border-2 border-pink-500 mt-4 rounded p-4 flex justify-center">
        <canvas   height="40vh" id="donationChart"></canvas>
    </div>
    <div style="height:40vh;" class="w-full border-2 border-pink-500 mt-4 rounded p-4 flex justify-center">
        <canvas id="donationPieChart" ></canvas>
    </div>
    <script>
        const ctx = document.getElementById('donationChart');
        let res = {!!  \App\Models\Donation::selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d") as created_date')->selectRaw('SUM(amount) as total_amount')->groupBy('created_date')->orderBy('created_at')->get() !!}
        new Chart(ctx, {
          type: 'line',
          data: {
            labels: res.map( e => e.created_date),
            datasets: [{
              label: 'Donations',
              data: res.map( e => e.total_amount),
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });

        const ctx1 = document.getElementById('donationPieChart');
        const data = {
            labels: [
                'Alumni', 
                'Students',
                'Coordinators',
            ],
            datasets: [{
                data: [{{\App\Models\User::whereType('Alumni')->count()}}, {{\App\Models\User::whereType('Student')->count()}}, {{\App\Models\User::whereType('Coordinator')->count()}}],
                backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
                }]
            };
            const config = {
                type: 'pie',
                data: data,
            };
            new Chart(ctx1, config)
      </script>
</div>
