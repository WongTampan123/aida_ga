@php
    $current_url = url()->current();

    $category_type = explode('aida_ga/dashboard/', $current_url);
    $category_type = ucwords($category_type[1]);
@endphp
<x-head title={{$title}}>
    <body class="relative flex flex-col h-screen min-w-screen overflow-auto bg-[#FBF6F0]">
        <x-navbar />
        <div class='grow max-h-[650.58px] w-full px-[10%] py-10'>
            <div class='mb-5 xl:container 2xl:mx-auto'>
                <p class="text-lg font-bold mb-1">{{$category_type}} Category</p>
                <ol class="flex items-center whitespace-nowrap" aria-label="Breadcrumb">
                    <li class="inline-flex items-center">
                        <a href={{url('/dashboard')}} class="flex items-center text-xs text-slate-500 font-semibold hover:text-green-aida focus:outline-none focus:text-green-aida" href="#">
                            Home
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-point-filled mx-1" width="5" height="5" viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 7a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" stroke-width="0" fill="currentColor" />
                        </svg>
                    </li>
                    <li class="inline-flex items-center">
                        <p class="flex items-center text-xs text-slate-400">
                            {{$category_type}} Category
                        </p>
                    </li>
                </ol>
            </div>
            <div class='w-full grid grid-cols-3 gap-6'>
                <!-- Dari sini nanti akan pakai foreach -->
                <div class='w-full h-[200px] flex flex-col p-6 justify-between rounded-lg bg-white drop-shadow-md'>
                    <div>
                        <p class='text-2xl font-semibold'>Televisi</p>
                    </div>
                    <div class='flex w-full justify-between items-start'>
                        <div>
                            <p class='text-sm text-slate-400 font-normal'>Total Assets</p>
                            <p class='text-6xl text-black font-bold'>57</p>
                        </div>
                        <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                            See All Assets
                        </button>
                    </div>
                </div>
                <div class='w-full h-[200px] flex flex-col p-6 justify-between rounded-lg bg-white drop-shadow-md'>
                    <div>
                        <p class='text-2xl font-semibold'>Webcam</p>
                    </div>
                    <div class='flex w-full justify-between items-start'>
                        <div>
                            <p class='text-sm text-slate-400 font-normal'>Total Assets</p>
                            <p class='text-6xl text-black font-bold'>8</p>
                        </div>
                        <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                            See All Assets
                        </button>
                    </div>
                </div>
                <div class='w-full h-[200px] flex flex-col p-6 justify-between rounded-lg bg-white drop-shadow-md'>
                    <div>
                        <p class='text-2xl font-semibold'>Microwave</p>
                    </div>
                    <div class='flex w-full justify-between items-start'>
                        <div>
                            <p class='text-sm text-slate-400 font-normal'>Total Assets</p>
                            <p class='text-6xl text-black font-bold'>5</p>
                        </div>
                        <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                            See All Assets
                        </button>
                    </div>
                </div>
                <div class='w-full h-[200px] flex flex-col p-6 justify-between rounded-lg bg-white drop-shadow-md'>
                    <div>
                        <p class='text-2xl font-semibold'>Mouse</p>
                    </div>
                    <div class='flex w-full justify-between items-start'>
                        <div>
                            <p class='text-sm text-slate-400 font-normal'>Total Assets</p>
                            <p class='text-6xl text-black font-bold'>128</p>
                        </div>
                        <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                            See All Assets
                        </button>
                    </div>
                </div>
                <div class='w-full h-[200px] flex flex-col p-6 justify-between rounded-lg bg-white drop-shadow-md'>
                    <div>
                        <p class='text-2xl font-semibold'>Keyboard</p>
                    </div>
                    <div class='flex w-full justify-between items-start'>
                        <div>
                            <p class='text-sm text-slate-400 font-normal'>Total Assets</p>
                            <p class='text-6xl text-black font-bold'>47</p>
                        </div>
                        <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                            See All Assets
                        </button>
                    </div>
                </div>
                <div class='w-full h-[200px] flex flex-col p-6 justify-between rounded-lg bg-white drop-shadow-md'>
                    <div>
                        <p class='text-2xl font-semibold'>Shredder</p>
                    </div>
                    <div class='flex w-full justify-between items-start'>
                        <div>
                            <p class='text-sm text-slate-400 font-normal'>Total Assets</p>
                            <p class='text-6xl text-black font-bold'>4</p>
                        </div>
                        <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                            See All Assets
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</x-head>