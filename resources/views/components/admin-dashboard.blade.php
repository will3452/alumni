<div class="bg-white border-2 rounded p-4 pt-8 overflow-scroll" style="height:80vh;">
    <div class="relative w-full md:w-1/4 shadow-xl border-2 border-pink-500 rounded">
        <div class="relative  rounded inline-block p-2 -top-5 left-5 bg-pink-500 text-white">
            Total Donations
        </div>
        <div class="text-right text-gray-700 font-bold text-xl p-2">
            PHP {{ \App\Models\Donation::whereNotNull('ApprovedAt')->sum('amount') }}
        </div>
        <div class="text-center border-t-2 text-sm font-mono p-2">
            {{ \Carbon\Carbon::now()->format('m/d/y')}}
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

        new Chart(ctx, {
          type: 'line',
          data: {
            labels: ['10/21/23', '10/22/23', '10/25/23', '11/1/23', '11/2/23', '11/15/23'],
            datasets: [{
              label: 'Donations',
              data: [12, 19, 3, 5, 2, 3],
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
                'Red',
                'Blue',
                'Yellow'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
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
