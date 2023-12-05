<div class="relative">
    <div class="p-4  opacity-10  rounded relative overflow-y-hidden " style="height: 70vh; background: url('/trajectory.png');   background-size: contain;background-position:center; background-repeat: no-repeat;  ">
    
    </div>
    <div class="absolute w-full top-0 ">

        <div class="flex h-full">
            <x-menu href="/alumni/donations">Donations</x-menu>
            <x-menu href="/news">Posts</x-menu>
            <x-menu href="/set-goal">Goals</x-menu>
            <x-menu href="/add-progress">Add Progress</x-menu>
        </div>
        
        <div>
            <canvas id="viz" width="400" height="100">
                <p>Vizualizagion goes here.</p>
            </canvas>
        </div>
    </div>
</div>

<script>
    let ctx = document.getElementById('viz')

    const labels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
    const data = {
    labels: labels,
    datasets: [
        {
            label: 'Career Progress',
            data: @json(\App\Models\CareerProgress::whereType('Career')->whereUserId(auth()->id())->get()->pluck('salary')),
            fill: true,
        },
    ]
    };
    const config = {
        type: 'line',
        data: data,
    };

    new Chart(ctx, config)
</script>