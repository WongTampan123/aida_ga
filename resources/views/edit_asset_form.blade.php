@php
    $current_url = url()->current();

    $url_explode = explode('/', $current_url);    
    $category_type = ucfirst($url_explode[5]);
    $subcategory_type = ucfirst($url_explode[6]);
    $asset_id=$url_explode[7]
@endphp

<x-head title='{{$title}}'>
    <body class="flex flex-col min-w-screen overflow-auto bg-[#FBF6F0] overflow-auto">
        <x-navbar />
        <div class='flex flex-col h-fit w-full px-[10%] py-10'>
            <div class='flex items-end justify-between mb-4 xl:container 2xl:mx-auto'>
                <div>
                    <p class="text-lg font-bold mb-1">Asset Detail</p>
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
                            <a href={{url('/dashboard/'.strtolower($category_type))}} class="flex items-center text-xs text-slate-500 font-semibold hover:text-green-aida focus:outline-none focus:text-green-aida" href="#">
                                {{$category_type}} Category
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-point-filled mx-1" width="5" height="5" viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 7a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" stroke-width="0" fill="currentColor" />
                            </svg>
                        </li>
                        <li class="inline-flex items-center">
                            <a href={{url('/dashboard/'.strtolower($category_type).'/'.strtolower($subcategory_type))}} class="flex items-center text-xs text-slate-500 font-semibold hover:text-green-aida focus:outline-none focus:text-green-aida" href="#">
                                {{$subcategory_type}}
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-point-filled mx-1" width="5" height="5" viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 7a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" stroke-width="0" fill="currentColor" />
                            </svg>
                        </li>
                        <li class="inline-flex items-center">
                            <p class="flex items-center text-xs text-slate-400">
                                {{$asset_id}}
                            </p>
                        </li>
                    </ol>
                </div>
                <div>
                    <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                        </svg> 
                        Print Asset
                    </button>
                </div>
            </div>           
            <div class='flex w-full h-[350px] gap-5 mb-7 xl:container 2xl:mx-auto'>
                <div class='grid grid-rows-2 gap-8 w-1/4 h-full'>
                    <div class='flex items-center justify-between h-full w-full rounded-lg bg-white p-5'>
                        <p class="inline-flex h-full items-start text-lg font-bold mb-5">Foto Barang</p>
                        <div class='w-[100px] h-[100px] border-2 border-[#FBF6F0] rounded-md'>
                            <img class="object-contain w-full h-full" src="{{asset('/assets/gambar_barang/'.$asset_data->gambar_barang)}}" alt="Asset Image">
                        </div>
                    </div>
                    <div class='flex items-center justify-between h-full w-full rounded-lg bg-white p-5'>
                        <div class='flex flex-col h-full'>
                            <p class="text-lg font-bold">QR Barang</p>
                            <p class="text-md text-gray-400 font-semibold">{{$asset_id}}</p>
                        </div>                        
                        <div class='w-[100px] h-[100px] border-2 border-[#FBF6F0] rounded-md'>
                            <img class="object-contain w-full h-full" src="{{asset('/assets/qr_test.svg')}}" alt="Asset Image">
                        </div>
                    </div>
                </div>                
                <div class='grow h-full rounded-lg bg-white p-5 grid grid-cols-3 gap-10'>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Jenis Barang</p>
                        <input type="text" placeholder='{{ucwords($asset_data->jenis_barang)}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Tipe Barang</p>
                        <input type="text" placeholder='{{ucwords($asset_data->tipe_barang)}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Kode Barang</p>
                        <input type="text" placeholder='{{$asset_data->id_barang}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Quantity</p>
                        <input type="text" placeholder='{{$asset_data->quantity_barang}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Merk</p>
                        <input type="text" placeholder='{{ucwords($asset_data->merk_barang)}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Lantai</p>
                        <input type="text" placeholder='{{$asset_data->lantai_barang}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Ruangan</p>
                        <input type="text" placeholder='{{ucwords($asset_data->ruangan_barang)}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Tahun</p>
                        <input type="text" placeholder='{{$asset_data->tahun_barang}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Unit</p>
                        <input type="text" placeholder='{{$asset_data->unit_barang}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                </div>
            </div>
            <div class='flex w-full justify-end xl:container 2xl:mx-auto'>
                <div class="flex gap-2">
                    <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm rounded-lg border border-transparent bg-slate-100 text-black hover:bg-slate-200 disabled:opacity-50 disabled:pointer-events-none">
                        Cancel
                    </button>
                    <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                        Update
                    </button>
                </div>
            </div>
        </div>        
    </body>
</x-head>