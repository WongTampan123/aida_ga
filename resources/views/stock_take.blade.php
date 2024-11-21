@php
    header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: Fri, 01 Jan 1990 00:00:00 GMT');
@endphp
<x-head title={{$title}}>
    <body class="flex flex-col min-w-screen overflow-auto bg-[#FBF6F0] overflow-auto">
        <x-navbar />
        <div class='flex flex-col min-h-screen w-full px-[5%] py-10'>
            <div class='mb-5 md:container md:mx-auto'>
                <p class="text-lg font-bold mb-1">Stock Take</p>
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
                            Stock Take
                        </p>
                    </li>
                </ol>
            </div>
            <div class='flex flex-col max-md:h-full h-fit min-h-[750px] w-full rounded-lg bg-white p-5 mb-5 md:container md:mx-auto'>                                
                <div class='flex max-md:flex-col w-full sm:justify-between mb-5'>
                    <!-- Untuk Filter, bisa dikembangkan selagi jalan-->
                    <!-- Filter -->
                    <div class="flex max-md:justify-end max-sm:justify-center gap-2 max-md:mb-4 md:hidden">
                        <!-- Masalah Filter Ikutin Asset -->
                        <a href={{url('/stock_take/add')}}>
                            <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center gap-x-2 text-sm max-sm:text-xs rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                                + Add Stock Take
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
                        <input id="search_asset" type="text" placeholder="Search Asset" class="w-full focus:outline-none focus:ring-0 border-0 py-0 text-[14px] bg-[#F6F6F6] pl-8">
                        <svg id="loading" class="animate-spin text-[#9AA1B7] hidden" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </div>   
                    <!-- Filter -->
                    <div class="flex max-md:hidden gap-2">
                        <!-- Masalah Fiter, Ikutin Seperti Asset -->
                         @if(session('user')->privilage['stock_take']=='true')
                            <a href={{url('/stock_take/add')}}>
                                <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                                    + Add Stock Take
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
                <div id='stock_take_table' class='grow flex flex-col justify-between w-full h-full'>
                </div>                
            </div>
        </div>
    </body>
    <script type='text/javascript'>
        var url = new URL(window.location.href)
        var params = new URLSearchParams(url.search)

        var typingTimer
        var typingInterval = 1000
        var searchAsset = document.getElementById('search_asset')
        var searchText = ''

        searchStockTake()      

        searchAsset.addEventListener('keyup', ()=>{
            document.getElementById('loading').classList.remove('hidden')
            clearTimeout(typingTimer)
            typingTimer = setTimeout(() => {           
                // axios.get("{{url('/search_user?input=')}}"+userSearch.value).then((res)=>{
                //   document.getElementById('user_table').innerHTML = res.data.view
                //   document.getElementById('loading').classList.add('hidden')
                // })
                searchText = document.getElementById('search_asset').value
                searchBarang()
                document.getElementById('loading').classList.add('hidden')
            }, typingInterval);
        })

        function searchStockTake(){
            axios.get("{{url('/search_stock_take')}}", {
                params:{
                    stock_take_id: searchText
                }
            }).then((res)=>{
                console.log(res)
                document.getElementById('stock_take_table').innerHTML = res.data.view
            }).catch((res)=>{
                console.log(res)
            })
        }

        function deleteAsset(id){
            Swal.fire({
                title: "Apakah Anda Yakin?",
                html: "Anda Tidak Bisa Mengurungkan Asset yang Sudah Anda Hapus!",
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

        function changePage(url){
            console.log(url)
            axios.get(url, {
                params:{
                    stock_take_id: searchText
                }
            }).then((res)=>{
                console.log(res)
                document.getElementById('stock_take_table').innerHTML = res.data.view
            }).catch((res)=>{
                console.log(res)
            })
            // axios.get(url).then((res)=>{
            // document.getElementById('user_table').innerHTML = res.data.view
            // })
        }

        function capitalizeWord(input){
            var capitalize = input.split(' ')
                            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                            .join(' ')

            return capitalize
        }        
    </script>
    <script type='text/javascript'>

    </script>
</x-head>
    