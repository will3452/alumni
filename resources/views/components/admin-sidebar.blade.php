<div  style="background: #800000" class="w-1/5 text-center h-screen hidden md:block text-white p-4 relative">
    <div class="flex  items-center mb-4 bg-white p-2 rounded-xl">
        <img src="/logo.png" class="w-16" alt="">
        <h1 class="font-bold text-black mx-2 text-2xl">CAREER CONNECT</h1>
    </div>
    <div class="my-10"></div>
    <a href="/home" class="block bg-pink-500 p-2 rounded relative w-full  z-10 text-pink-100 mb-4">
        Dashboard
    </a>
    <a href="/users" class="block bg-pink-500 p-2 rounded relative w-full  z-10 text-pink-100 mb-4">
        Manage User Accounts
    </a>
    <a href="{{route('admin.donation.index')}}" class="block bg-pink-500 relative w-full  z-10 p-2 rounded text-pink-100 mb-4">
        Manage Donations
    </a>
    <a href="/courses" class="block bg-pink-500 p-2 rounded relative w-full  z-10  text-pink-100 mb-4 ">
        Manage Courses
    </a>
    <a href="{{route('alumni.profile.show', ['user' => auth()->id()])}}" class="relative w-full z-10 block bg-pink-500 p-2 rounded text-pink-100 mb-4">
        Manage Profile
    </a>

    <img src="/sidebar.png"  alt="" class="z-0 absolute -bottom-5">
</div>