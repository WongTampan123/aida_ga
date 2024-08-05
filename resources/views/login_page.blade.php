<x-head>
    <body class="relative flex items-center items-center max-md:justify-center md:overflow-hidden min-h-screen min-w-screen md:bg-login">
        {{-- linear-gradient(to left, #1B84FF 50%, #FFFFFF 50%) --}}
            <div class="max-md:absolute w-[50%] max-md:w-full px-32 max-sm:px-8 flex flex-col items-center max-md:z-10 2xl:container 2xl:m-auto">  
                <img src="{{asset('assets/aida_logo_green.svg')}}" alt="AIDA Logo Green" class="mb-2 w-60 h-auto">
                <p class="text-xl font-normal text-green-aida mb-10">Aplikasi Inventarisasi Data Asset</p>
                <p class="text-2xl font-semibold mb-2">Sign In</p>
                <p class="text-xl font-normal text-slate-400 mb-16 max-sm:mb-10">Welcome to AIDA!</p>
                <form class="flex flex-col gap-6 w-full" action="{{url('/login')}}" method="POST">
                    @csrf
                    <input class="p-3 w-full ring-2 ring-gray-900/10 focus:outline-none focus:ring-3 focus:ring-green-aida rounded-lg" name="loginusername" type="text" placeholder="NIK Telkom Group" autocomplete="off">
                    <input class="p-3 w-full ring-2 ring-gray-900/10 focus:outline-none focus:ring-3 focus:ring-green-aida rounded-lg" name="loginpassword" type="password" placeholder="Password">
                    <a href="https://portal.telkom.co.id/login/forgot">
                        <p class="text-lg font-medium text-right text-green-aida cursor-pointer">Forgot Password?</p>
                    </a>
                    <button class="w-full p-3 text-lg bg-green-aida text-white rounded-md mt-4 hover:bg-green-400 hover:text-white focus:outline-none focus:bg-green-400 focus:text-white mb-6">Sign In</button>
                </form>
            </div>
            <div class="max-md:absolute w-[50%] max-md:w-full max-sm:pt-16 px-32 flex flex-col items-center max-md:z-0 max-md:hidden 2xl:container 2xl:m-auto">                
                <img src="{{asset('assets/aida_login_image.svg')}}" alt="Login Image" class="mb-6 text-center" style="width: 70%; height: auto;">
                <p class="text-3xl font-semibold text-white text-center mb-4">Well Managed-Assets</br>Are an Invesment in the Future</p>
                <p class="text-md font-light text-white text-center">Effective Asset Management Supports Company Growth</p>
            </div>
            <div class="flex items-end justify-center bg-green-aida min-h-screen w-full opacity-20 md:hidden">
                <img src="{{asset('assets/aida_login_image.svg')}}" alt="Login Image" class="mb-6">
            </div>
    @include('sweetalert::alert')
    </body>
</x-head>

