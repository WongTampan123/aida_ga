<x-head>
    <body class="relative flex items-center items-center max-md:justify-center md:overflow-hidden min-h-screen min-w-screen 2xl:container 2xl:m-auto md:bg-login">
        {{-- linear-gradient(to left, #1B84FF 50%, #FFFFFF 50%) --}}
            <div class="max-md:absolute w-[50%] max-md:w-full px-32 max-sm:px-8 flex flex-col items-center max-md:z-10">  
                <img src="{{asset('assets/moves_logo_blue.png')}}" alt="Moves Logo White" class="mb-20 max-sm:mb-10">
                <p class="text-2xl font-semibold mb-2">Sign In</p>
                <p class="text-xl font-normal text-slate-400 mb-16 max-sm:mb-10">Welcome to MOVES!</p>
                <form class="flex flex-col gap-6 w-full" action="{{url('/login')}}" method="POST">
                    @csrf
                    <input class="p-3 w-full ring-2 ring-gray-900/10 focus:outline-none focus:ring-3 focus:ring-sky-500 rounded-lg" name="loginusername" type="text" placeholder="NIK Telkom Group" autocomplete="off">
                    <input class="p-3 w-full ring-2 ring-gray-900/10 focus:outline-none focus:ring-3 focus:ring-sky-500 rounded-lg" name="loginpassword" type="password" placeholder="Password">
                    <a href="https://portal.telkom.co.id/login/forgot">
                        <p class="text-lg font-medium text-right text-[#1B84FF] cursor-pointer">Forgot Password?</p>
                    </a>
                    <button class="w-full p-3 text-lg bg-[#1B84FF] text-white rounded-md mt-4 hover:bg-sky-500 hover:text-white focus:outline-none focus:bg-sky-500 focus:text-white mb-6">Sign In</button>
                </form>
                <div class="flex w-full text-lg text-[#1B84FF] justify-center gap-6">
                    <a class="hover:cursor-pointer" href="{{url('/about')}}">About MOVES</a>
                    <div class="hover:cursor-default">|</div>
                    <div class="hover:cursor-pointer">Support</div>
                </div>
            </div>
            <div class="max-md:absolute w-[50%] max-md:w-full max-sm:pt-16 px-32 flex flex-col items-center max-md:z-0 max-md:hidden">
                <img src="{{asset('assets/moves_logo_white.png')}}" alt="Moves Logo White" class="mb-6">
                <p class="text-xl font-normal text-white mb-16 mb-16">Transforming Habits, Building Healthier Lives!</p>
                <a href="{{url('/dashboard')}}"><img src="{{asset('assets/login_image.png')}}" alt="Login Image" class="mb-6" style="width: 100%; height: auto;"></a>
            </div>
            <div class="flex items-end bg-blue-500 min-h-screen min-w-screen opacity-20 md:hidden">
                <img src="{{asset('assets/login_image.png')}}" alt="Login Image" class="mb-6">
            </div>
    @include('sweetalert::alert')
    </body>
</x-head>