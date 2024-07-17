@php
    $user = Session::get('user');
    if($user->profile_picture=='dummy.jpg'){
        $profile_picture = asset('assets/default_profile_image.png');
    } else {
        $profile_picture = 'https://pmo-oneflux.mitratel.co.id/profile_picture/'.Session::get('user')->profile_picture;
    }

    $lower_name = strtolower($user->name);
    $user->name = ucwords($lower_name);
@endphp

<div class="w-full h-[50px] md:h-[60px] md:px-[10%] bg-green-aida z-10 max-md:z-20">
    <div class="w-full h-full flex justify-between items-center 2xl:container 2xl:mx-auto">
        <div class="h-full flex items-center">
            <img onclick="window.location.href='{{url("/dashboard")}}'" src="{{asset('assets/navbar_logo.svg')}}" alt="AIDA Logo" class="mr-20 cursor-pointer w-[103px] max-md:w-[70px] h-auto">
        </div>
        <div class='flex'>
            <div class='flex flex-col justify-center text-right mr-4'>
                <p class='text-xs font-semibold text-white mb-0.5 leading-tight'>{{$user->name}}</p>
                <p class='text-xs font-light text-white'>{{$user->short_posisi}}</p>
            </div>
            <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                <button id="hs-dropdown-default" class="hs-dropdown-toggle rounded-md overflow-hidden w-[40px] h-[40px] max-sm:w-[30px] max-sm:h-[30px]">
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
<div class='w-full h-[100px] bg-white px-[10%]'>
    <div class='w-full h-full flex items-center justify-between py-4 2xl:container 2xl:mx-auto'>
        <div class='w-[25%] h-full flex flex-col justify-center'>
            <p class='font-bold text-base text-green-aida'>Dashboard</p>
            <p class='font-medium text-sm text-slate-400'>Summary & Reports</p>
        </div>        
        <div class='w-[25%] h-full flex flex-col justify-center pl-4 border-l-2 border-[#FBF6F0] cursor-default'>
            <p class='font-bold text-base text-black hover:text-green-aida cursor-pointer'>Assets</p>
            <p class='font-medium text-sm text-slate-400'>List of Assets</p>
        </div> 
        <div class='w-[25%] h-full flex flex-col justify-center pl-4 border-l-2 border-[#FBF6F0] cursor-default'>
            <p class='font-bold text-base text-black hover:text-green-aida cursor-pointer'>Stock Table</p>
            <p class='font-medium text-sm text-slate-400'>Assets Validation</p>
        </div> 
        <div class='w-[25%] h-full flex flex-col justify-center pl-4 border-l-2 border-[#FBF6F0] cursor-default'>
            <p class='font-bold text-base text-black hover:text-green-aida cursor-pointer'>Bulk Upload</p>
            <p class='font-medium text-sm text-slate-400'>Mass Asset Update</p>
        </div> 
    </div>
</div>