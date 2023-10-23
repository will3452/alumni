<div class="w-1/4 bg-black text-center h-screen text-white p-4 relative">
    <div class="flex justify-between items-center mb-4">
        <div class="w-10 h-10 rounded-full bg-white"></div>
        <h1 class="font-bold">CAREER CONNECT</h1>
    </div>
    <div class="my-10"></div>
    <a href="/home" class="block bg-pink-500 p-2 rounded text-pink-100 mb-4">
        Dashboard
    </a>
    <a href="/users" class="block bg-pink-500 p-2 rounded text-pink-100 mb-4">
        Manage User Accounts
    </a>
    <a href="{{route('admin.donation.index')}}" class="block bg-pink-500 p-2 rounded text-pink-100 mb-4">
        Manage Donations
    </a>
    <a href="{{route('admin.donation.index')}}" class="block bg-pink-500 p-2 rounded text-pink-100 mb-4">
        Manage Courses
    </a>
    <a href="{{route('alumni.profile.show', ['user' => auth()->id()])}}" class="block bg-pink-500 p-2 rounded text-pink-100 mb-4">
        Manage Profile
    </a>

    <img src="/sidebar.png" alt="" class="absolute bottom-0">
</div>