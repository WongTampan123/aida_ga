@php
    $current_url = url()->current();

    $url_explode = explode('/', $current_url);    
    $category_type = ucfirst($url_explode[5]);
@endphp

<x-head title={{$title}}>
    <body class="flex flex-col min-w-screen overflow-auto bg-[#FBF6F0] overflow-auto">
        <x-navbar />
        <div class='flex flex-col min-h-screen w-full px-[5%] py-10'>
            <div class='mb-5 md:container md:mx-auto'>
                <p class="text-lg font-bold mb-1">{{$category_type}}</p>
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
            <div class='max-md:h-full h-fit min-h-[650px] w-full rounded-lg bg-white p-5 mb-5 md:container md:mx-auto'>                                
                <div class='flex max-md:flex-col w-full sm:justify-between mb-5'>
                    <div class="flex max-md:justify-end gap-2 max-md:mb-4 md:hidden">
                        <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm max-sm:text-xs rounded-lg border border-transparent bg-green-100 text-green-aida hover:bg-green-200 disabled:opacity-50 disabled:pointer-events-none">
                            Filter
                        </button>
                        <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm max-sm:text-xs rounded-lg border border-transparent bg-green-100 text-green-aida hover:bg-green-200 disabled:opacity-50 disabled:pointer-events-none">
                            Export
                        </button>
                        <a href="{{url('assets/add_asset')}}">
                            <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center gap-x-2 text-sm max-sm:text-xs rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                                + Add Asset
                            </button>
                        </a>
                    </div>
                    <div class="w-80 max-md:w-full py-1 px-2 h-full relative flex items-center bg-[#F6F6F6] rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute icon icon-tabler icon-tabler-search stroke-[#9AA1B7]" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="#9AA1B7" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                            <path d="M21 21l-6 -6" />
                        </svg>
                        {{-- Search Assets --}}
                        <input id="search_user" type="text" placeholder="Search Asset" class="w-full focus:outline-none focus:ring-0 border-0 py-0 text-[14px] bg-[#F6F6F6] pl-8">
                        <svg id="loading" class="animate-spin text-[#9AA1B7] hidden" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>
                    <div class="flex max-md:hidden gap-2">
                        <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-100 text-green-aida hover:bg-green-200 disabled:opacity-50 disabled:pointer-events-none">
                            Filter
                        </button>
                        <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-100 text-green-aida hover:bg-green-200 disabled:opacity-50 disabled:pointer-events-none">
                            Export
                        </button>
                        <a href="{{url('assets/add_asset?category='.strtolower($category_type))}}">
                            <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                                + Add Asset
                            </button>
                        </a>
                    </div>
                </div>
                <div class='w-full h-full overflow-auto'>
                    <table class="max-md:w-[300%] w-full h-full divide-y divide-gray-200">
                        <thead class="sticky top-0 bg-white">
                            <tr>
                                <th class="py-1 items-center text-center">
                                    <input type="checkbox" class="inline-flex items-center shrink-0 mt-0.5 border-gray-200 rounded text-green-600 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none bg-[#F6F6F6]">
                                </th>
                                <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">NO</th>
                                <th scope="col" class="text-start text-xs font-semibold text-gray-500 uppercase">Jenis & Tipe Barang</th>
                                <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">KODE</th>
                                <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">AREA</th>
                                <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">QTY</th>
                                <th scope="col" class="text-start text-xs font-semibold text-gray-500 uppercase">MERK</th>
                                <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">LANTAI</th>
                                <th scope="col" class="text-start text-xs font-semibold text-gray-500 uppercase">RUANGAN</th>
                                <th scope="col" class="text-start text-xs font-semibold text-gray-500 uppercase">TAHUN</th>
                                <th scope="col" class="text-start text-xs font-semibold text-gray-500 uppercase">UNIT</th>
                                <th></th>
                            </tr>
                        </thead>
                        @foreach($asset_list as $asset)
                        <tbody class='divide-y divide-gray-200'>
                            <tr class="h-16 hover:bg-green-200">
                                {{-- Checkbox --}}
                                <td class="text-center">
                                    <input type="checkbox" class="inline-flex items-center shrink-0 border-gray-200 rounded text-green-600 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none bg-[#F6F6F6]">
                                </td>
                                <td class="text-base text-black text-center">1</td>
                                <td class="relative flex items-center h-full">
                                    <div class="h-9 w-9 overflow-hidden mr-3">
                                        <img class="object-contain w-full h-full" src="{{asset('/assets/gambar_barang/'.$asset->gambar_barang)}}" alt="Asset Image">
                                    </div>
                                    <div>
                                        <p class="text-base font-medium truncate">{{ucwords($asset->tipe_barang)}}</p>
                                        <p class="text-xs text-gray-300 whitespace-nowrap">Seri:{{$asset->seri_barang}}</p>
                                    </div>
                                </td>
                                <td class="text-center"><span class="text-xs font-semibold py-0.5 px-2 text-black rounded-md bg-[#F6F6F6]">{{$asset->id_barang}}</span></td>
                                <td class="text-sm text-gray-500 text-center">{{$asset->area_barang}}</td>
                                <td class="text-sm text-gray-500 text-center">{{$asset->quantity_barang}}</td>
                                <td class="text-sm text-gray-500 text-start">{{$asset->merk_barang}}</td>
                                <td class="text-sm text-gray-500 text-center">{{$asset->lantai_barang}}</td>
                                <td class="text-sm text-gray-500 text-start">{{$asset->ruangan_barang}}</td>
                                <td class="text-sm text-gray-500 text-start">{{$asset->tahun_barang}}</td>
                                <td class="text-sm text-gray-500 text-start">{{$asset->unit_barang}}</td>
                                <td>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button id="hs-dropdown-default" type="button" class="hs-dropdown-toggle py-1 px-2 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg bg-[#F6F6F6] text-black hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                            Actions
                                            <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                        </button>

                                        <div class="hs-dropdown-menu transition-[opacity,margin] z-10 duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-32 bg-white shadow-md rounded-lg p-2 mt-2after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" aria-labelledby="hs-dropdown-default">
                                            <a href="{{url('/assets/'.$asset->id_barang)}}" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                                Edit
                                            </a>
                                            <a onclick='deleteAsset({{$asset->id}})' class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100" href="#">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>                
            </div>
        </div>
    </body>
    <script type='text/javascript'>
        function deleteAsset(id){
            Swal.fire({
                title: "Apakah Anda Yakin?",
                html: "Anda Tidak Bisa Mengurungkan Asset yang Sudah Anda Hapus",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#17C653",
                cancelButtonColor: "#d33",
                confirmButtonText: "Lanjutkan"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('{{url("/delete_asset")}}',{
                        id_barang: id
                    }).then((res)=>{
                        swal.fire({
                            title:'Asset Berhasil Dihapus',
                            icon: 'success',
                            text:`Asset yang Anda Pilih Berhasil Terhapus`,
                            confirmButtonColor: "#17C653",
                        }).then((result)=>{
                            if(result.isConfirmed){
                                location.reload()
                            }
                        })
                    }).catch((res)=>{
                        swal.fire({
                            icon: 'warning',
                            text:`Terdapat Masalah Saat Menghapus Asset, Silahkan Kontak Tim GA`,
                            confirmButtonColor: "#17C653",
                        })
                    })
                }
            })       
        }
    </script>
</x-head>
    