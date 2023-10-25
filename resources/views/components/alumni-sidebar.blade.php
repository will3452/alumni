<div  style="background: #800000" class="w-1/4 text-center h-screen text-white p-4 relative">
    <div class="flex  items-center mb-4 bg-white p-2 rounded-xl">
        <img src="/logo.png" class="w-16" alt="">
        <h1 class="font-bold text-black mx-2 text-2xl">CAREER CONNECT</h1>
    </div>
    <div class="my-10"></div>
    <a href="/home" class="block bg-pink-500 p-2 rounded text-pink-100 mb-4">
        Dashboard
    </a>
    <a href="/news" class="block bg-pink-500 p-2 rounded text-pink-100 mb-4">
        Post News and Job Offers
    </a>
    <a href="/notifications" class="block bg-pink-500 p-2 rounded text-pink-100 mb-4">
        Notifications
    </a>
    <a href="{{route('alumni.donations')}}" class="block bg-pink-500 p-2 rounded text-pink-100 mb-4">
        Donations
    </a>
    <a href="{{route('alumni.profile.show', ['user' => auth()->id()])}}" class="block bg-pink-500 p-2 rounded text-pink-100 mb-4">
        Profile
    </a>

    <img src="/sidebar.png" alt="" class="absolute -bottom-5">
</div>