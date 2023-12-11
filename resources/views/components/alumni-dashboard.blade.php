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

        <div>
            <canvas id="don" width="400" height="100">
                <p>Vizualizagion goes here.</p>
            </canvas>
        </div>
    </div>
</div>


<script>
    let ctxc = document.getElementById('viz')
    const levels = {
        'Mid': 1,
        'Junior': 2,
        'Senior': 3, 
    }
    const labels = @json(\App\Models\CareerProgress::whereType('Career')->whereUserId(auth()->id())->get()->pluck('year')) 
    const datax = {
    labels: labels,
    datasets: [
        {
            label: 'Career Progress',
            data: @json(\App\Models\CareerProgress::whereType('Career')->whereUserId(auth()->id())->get()->pluck('level')).map(e => levels[e]),
            fill: true,
        },
    ]
    };
    const configx = {
        type: 'line',
        data: datax,
    };

    new Chart(ctxc, configx)
</script>
<x-chart></x-chart>