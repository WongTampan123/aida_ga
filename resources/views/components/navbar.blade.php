@php
    if(Session::get('user')->profile_picture=='dummy.jpg'){
        $profile_picture = asset('assets/default_profile_image.png');
    } else {
        $profile_picture = 'https://pmo-oneflux.mitratel.co.id/profile_picture/'.Session::get('user')->profile_picture;
    }    
@endphp

<div class="w-full h-[65px] md:h-[80px] fixed bg-white shadow-md z-10 max-md:z-20">
    <div class="w-full h-full px-5 flex justify-between items-center 2xl:container 2xl:mx-auto">
        <div class="h-full flex items-center">
            <img onclick="window.location.href='{{url("/dashboard")}}'" src="{{asset('assets/navbar_logo.svg')}}" alt="AIDA Logo" class="mr-20 cursor-pointer w-[103px] max-md:w-[70px] h-auto">
        </div>
        <div class="hs-dropdown relative inline-flex">
            <button id="hs-dropdown-default" class="hs-dropdown-toggle rounded-full overflow-hidden w-[45px] h-[45px] max-sm:w-[35px] max-sm:h-[35px]">
                <img src="{{$profile_picture}}" alt="Default Profile Image" class="object-cover w-full h-full">
            </button>

            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 border-2 border-gray-900/10 bg-white shadow-md rounded-lg py-2 mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" aria-labelledby="hs-dropdown-default">
                <form action={{url('/logout')}} method="POST">
                    @csrf
                    <button class="w-full">
                        <a class="flex items-center py-2 px-3 text-sm text-gray-800 hover:bg-red-100 focus:outline-none focus:bg-gray-100">
                        Log Out
                        </a>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>