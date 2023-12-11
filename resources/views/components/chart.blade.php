<div class="w-full mb-4 border-2 border-pink-500 rounded p-4 flex justify-center">
    <canvas   height="40vh" id="donationChart"></canvas>
</div>
<div style="height:40vh;" class="w-full border-2 border-pink-500  rounded p-4 flex justify-center">
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