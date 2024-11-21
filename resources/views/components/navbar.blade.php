@php
    $user = Session::get('user');
    if($user->profile_picture=='dummy.jpg'){
        $profile_picture = asset('assets/default_profile_image.png');
    } else {
        $profile_picture = 'https://pmo-oneflux.mitratel.co.id/profile_picture/'.Session::get('user')->profile_picture;
    }

    $lower_name = strtolower($user->name);
    $user->name = ucwords($lower_name);
    $current_path = explode("/", request()->path());
@endphp

<div class="w-full h-[60px] px-[5%] bg-green-aida">
    <div class="w-full h-full flex justify-between items-center 2xl:container 2xl:mx-auto">
        <div class="flex h-full flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2 mr-2 lg:hidden" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round" aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-offcanvas-example" aria-label="Toggle navigation" data-hs-overlay="#hs-offcanvas-example">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M4 6l16 0" />
                <path d="M4 12l16 0" />
                <path d="M4 18l16 0" />
            </svg>

            <!-- Sidebar -->
            <div id="hs-offcanvas-example" class="hs-overlay [--auto-close:lg] hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden fixed top-0 start-0 bottom-0 z-[60] w-64 bg-[#FBF6F0] border-e border-gray-200 pt-7 pb-10 overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300" role="dialog" tabindex="-1" aria-label="Sidebar">
            <div class="px-6">
                <img src="{{asset('assets/sidebar_logo.svg')}}" alt="AIDA Logo" class="mr-20 cursor-pointer w-[70%] h-auto">
            </div>
            <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
                <ul class="space-y-1.5">
                    <li>
                        <a class='flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg {{$current_path[0]=="dashboard"? "bg-green-aida text-white":"text-gray-700 hover:text-white hover:bg-green-aida hover:text-white"}}' href="{{url('/dashboard')}}">Dashboard</a>
                    </li>
                    <li>
                        <a class='flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg {{$current_path[0]=="assets"? "bg-green-aida text-white":"text-gray-700 hover:text-white hover:bg-green-aida hover:text-white"}}' href="{{url('/assets')}}">Assets</a>
                    </li>
                    <li>
                        <a class='flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg {{$current_path[0]=="stock_take"? "bg-green-aida text-white":"text-gray-700 hover:text-white hover:bg-green-aida hover:text-white"}}' href="{{url('/stock_take')}}">Stock Take</a>
                    </li>
                    <li>
                        <a class='flex items-center gap-x-3.5 py-2 px-2.5 text-sm rounded-lg {{$current_path[0]=="bulk_upload"? "bg-green-aida text-white":"text-gray-700 hover:text-white hover:bg-green-aida hover:text-white"}}' href="{{url('/bulk_upload')}}">Bulk Upload</a>
                    </li>
                </ul>
            </nav>
            </div>
            <!-- End Sidebar -->
            <img onclick="window.location.href='{{url("/dashboard")}}'" src="{{asset('assets/navbar_logo.svg')}}" alt="AIDA Logo" class="mr-20 cursor-pointer w-[103px] max-md:w-[70px] h-auto">
        </div>
        <div class='flex items-center'>
            <div class='flex flex-col justify-center text-right mr-4'>
                <p class='text-xs max-md:hidden font-semibold text-white mb-0.5 leading-tight'>{{$user->name}}</p>
                <p class='text-xs max-md:hidden font-light text-white'>{{$user->short_posisi}}</p>
            </div>
            <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                <button id="hs-dropdown-default" class="hs-dropdown-toggle rounded-md overflow-hidden w-[40px] h-[40px]">
                    <img src="{{$profile_picture}}" alt="Default Profile Image" class="object-cover w-full h-full">
                </button>

                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-48 border-2 border-gray-900/10 bg-white shadow-md rounded-lg py-1 mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" aria-labelledby="hs-dropdown-default">
                    <form action={{url('/logout')}} method="POST">
                        @csrf
                        <button class="w-full">
                            <a class="flex items-center py-1 px-3 text-sm text-gray-800 hover:bg-red-100 focus:outline-none focus:bg-gray-100">
                            Log Out
                            </a>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class='w-full h-[100px] bg-white px-[5%] max-lg:hidden'>
    <div class='w-full h-full flex items-center justify-between py-4 2xl:container 2xl:mx-auto'>
        <div class='w-[25%] h-full flex flex-col justify-center'>
            <a href="{{url('/dashboard')}}">
                <p class='font-bold text-base {{$current_path[0]=="dashboard"? "text-green-aida":"text-black hover:text-green-aida"}} cursor-pointer'>Dashboard</p>
            </a>
            <p class='font-medium text-sm text-slate-400'>Summary & Reports</p>
        </div>        
        <div class='w-[25%] h-full flex flex-col justify-center pl-4 border-l-2 border-[#FBF6F0] cursor-default'>
            <a href="{{url('/assets')}}">
                <p class='font-bold text-base {{$current_path[0]=="assets"? "text-green-aida":"text-black hover:text-green-aida"}} cursor-pointer'>Assets</p>
            </a>
            <p class='font-medium text-sm text-slate-400'>List of Assets</p>
        </div> 
        <div class='w-[25%] h-full flex flex-col justify-center pl-4 border-l-2 border-[#FBF6F0] cursor-default'>
            <a href="{{url('/stock_take')}}">
                <p class='font-bold text-base {{$current_path[0]=="stock_take"? "text-green-aida":"text-black hover:text-green-aida"}} cursor-pointer'>Stock Take</p>
            </a>
            <p class='font-medium text-sm text-slate-400'>Assets Validation</p>
        </div> 
        <div class='w-[25%] h-full flex flex-col justify-center pl-4 border-l-2 border-[#FBF6F0] cursor-default'>
            <a href="{{url('/bulk_upload')}}">
                <p class='font-bold text-base {{$current_path[0]=="bulk_upload"? "text-green-aida":"text-black hover:text-green-aida"}} cursor-pointer'>Bulk Upload</p>
            </a>            
            <p class='font-medium text-sm text-slate-400'>Mass Asset Update</p>
        </div> 
    </div>
</div>