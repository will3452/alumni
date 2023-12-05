@props(['bg', 'href' => '#'])
<a class="text-center block" href="{{$href}}">
    <div style="background:#800000;" class="w-20 text-white h-20 flex justify-center {{$bg ?? 'bg-red-700'}} items-center text-4xl rounded-xl m-2">
        {{substr($slot, 0, 1)}}
    </div>
    {{$slot}}
</a>