@php
    header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: Fri, 01 Jan 1990 00:00:00 GMT');
@endphp
<x-head title={{$title}}>
    <body class="flex flex-col min-w-screen overflow-auto bg-[#FBF6F0] overflow-auto">
        <x-navbar />
        <div class='flex flex-col min-h-screen w-full px-[5%] lg:px-[10%] py-10'>
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
                        <a href={{url('/stock_take')}} class="flex items-center text-xs text-slate-500 font-semibold hover:text-green-aida focus:outline-none focus:text-green-aida" href="#">
                            Stock Take
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-point-filled mx-1" width="5" height="5" viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 7a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" stroke-width="0" fill="currentColor" />
                        </svg>
                    </li>
                    <li class="inline-flex items-center">
                        <p class="flex items-center text-xs text-slate-400">
                            {{$stock_take_id}}
                        </p>
                    </li>
                </ol>
            </div>
            <div class='flex flex-col max-md:h-full h-fit min-h-[850px] w-full rounded-lg bg-white p-5 mb-5 md:container md:mx-auto'>                                
                <div class='flex max-md:flex-col w-full sm:justify-between mb-5'>
                    <div class="flex max-md:justify-end max-sm:justify-center gap-2 max-md:mb-4 md:hidden">
                        <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                            <button id="hs-dropdown-filter" type="button" class="hs-dropdown-toggle py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm max-sm:text-xs rounded-lg border border-transparent bg-green-100 text-green-aida hover:bg-green-200 disabled:opacity-50 disabled:pointer-events-none">
                                Filter
                            </button>

                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-48 border-2 border-gray-900/10 bg-white shadow-md rounded-lg py-1 mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" aria-labelledby="hs-dropdown-filter">
                                <button class="w-full">
                                    <a class="flex items-center py-1 px-3 text-sm text-gray-800 hover:bg-red-100 focus:outline-none focus:bg-gray-100">
                                    Log Out
                                    </a>
                                </button>
                            </div>
                        </div>
                        <a href="">
                            <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm max-sm:text-xs rounded-lg border border-transparent bg-green-100 text-green-aida hover:bg-green-200 disabled:opacity-50 disabled:pointer-events-none">
                                Export
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
                    <div class="flex max-md:hidden gap-2">
                        <details id='dropdown' class="dropdown dropdown-end">
                            <summary class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-100 text-green-aida hover:bg-green-200 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
                                Filter
                            </summary>
                            <div class="menu dropdown-content bg-base-100 rounded-lg z-20 w-64 p-2 mt-2 gap-2 shadow-[0_2px_5px_1px_rgba(0,0,0,0.15)]">
                                <select placeholder='Jenis Barang' class="filter-jenis-barang w-full text-sm py-1 px-2 focus:ring-green-aida border-0 bg-[#FBF6F0] rounded-lg cursor-pointer" name="" id="">
                                    <option></option>
                                    @foreach($jenis_barang_list as $jenis_barang)
                                        <option id='{{$jenis_barang->jenis_barang}}' value='{{$jenis_barang->jenis_barang}}'>{{ucfirst($jenis_barang->jenis_barang)}}</option>
                                    @endforeach                                   
                                </select>
                                <select placeholder='Tahun Pengadaan Barang' class="filter-tahun-barang w-full text-sm py-1 px-2 focus:ring-green-aida border-0 bg-[#FBF6F0] rounded-lg cursor-pointer" name="" id="">
                                    <option></option>
                                    @foreach($tahun_barang_list as $tahun_barang)
                                        <option value='{{$tahun_barang->tahun_barang}}'>{{ucfirst($tahun_barang->tahun_barang)}}</option>
                                    @endforeach                                   
                                </select>
                                <select placeholder='Tahun Pengadaan Barang' class="filter-unit-barang w-full text-sm py-1 px-2 focus:ring-green-aida border-0 bg-[#FBF6F0] rounded-lg cursor-pointer" name="" id="">
                                    <option></option>
                                    @foreach($unit_barang_list as $unit_barang)
                                        <option value='{{$unit_barang->nama_unit}}'>{{ucfirst($unit_barang->nama_unit)}}</option>
                                    @endforeach                                   
                                </select>
                            </div>
                        </details>
                        <a>
                            <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none"
                                aria-haspopup="dialog" 
                                aria-expanded="false" 
                                aria-controls="hs-slide-down-animation-modal" 
                                data-hs-overlay="#hs-slide-down-animation-modal"
                            >
                                Export
                            </button>
                        </a>
                    </div>
                </div>
                <div id='asset_table' class='grow flex flex-col justify-between w-full h-full'>
                </div>                
            </div>
        </div>
        <div id="hs-slide-down-animation-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-slide-down-animation-modal-label">
            <div class="hs-overlay-animation-target hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-xl sm:w-full m-3 sm:mx-auto">
                <div class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto">
                <div class="flex justify-between items-center py-3 px-4 border-b">
                    <h3 id="hs-slide-down-animation-modal-label" class="font-bold text-gray-800">
                        Export Stock Take to PDF
                    </h3>
                    <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none" aria-label="Close" data-hs-overlay="#hs-slide-down-animation-modal">
                    <span class="sr-only">Close</span>
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                    </button>
                </div>
                <div class="p-4 overflow-y-auto">
                    <p class="mt-1 text-lg text-gray-800 text-justify">
                    Silahkan Masukkan Nama yang Bertanda Tangan pada Dokumen Stock Take
                    </p>
                    <p class="mt-2 text-xs text-gray-500 italic text-justify">
                        (Jika Anda Belum Yakin Dengan Nama yang Bertanda Tangan, Anda Dapat Mengunduh Terlebih Dahulu Setelah Itu Mengeditnya di Aplikasi PDF Editor)     
                    </p>
                    <div class='my-8'>
                        <p class="text-md mb-1 font-semibold">
                            Manager General Affair
                        </p>
                        <input type="text" id='mgr_general_affair' placeholder='Manager General Affair' class="py-2 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                        <p class="text-md mt-7 mb-1 font-semibold">
                            VP Corporate Office
                        </p>
                        <input type="text" id='vp_corporate_office' placeholder='VP Corporate Office' class="py-2 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                        <p class="text-md mt-7 mb-1 font-semibold">
                            SVP Corporate Secretary
                        </p>
                        <input type="text" id='svp_corporate_secretary' placeholder='SVP Corporate Strategy' class="py-2 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-slide-down-animation-modal">
                    Close
                    </button>
                    <button type="button" onclick='exportDocument()' class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 focus:outline-none focus:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                    Export
                    </button>
                </div>
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
        var filterJenisBarang = params.get('jenis_barang')? params.get('jenis_barang'):''
        var filterTahunBarang = ''
        var filterUnitBarang = ''
        var filterStatusApproval = ''
        var searchText = ''
        var sort_asc = true

        searchBarang()
        if(filterJenisBarang != ''){
            document.getElementById(`${filterJenisBarang}`).setAttribute("selected","selected")
        }

        $(document).ready(function() {
            $('<link rel="stylesheet" href="{{asset('css/select2_filter.css')}}" />').appendTo('head')
            $('.filter-jenis-barang').select2({
            placeholder:'Jenis Barang',
            allowClear:true,
            templateResult: function(option) {
                if(option.element && (option.element).hasAttribute('hidden')){
                    return null;
                }
                return option.text;
            }
            });
            $('.filter-jenis-barang').on('change', function(){
            console.log(filterJenisBarang = $(this).val())
            searchBarang()
            })

            $('.filter-tahun-barang').select2({
            placeholder:'Tahun Barang',
            allowClear:true,
            templateResult: function(option) {
                if(option.element && (option.element).hasAttribute('hidden')){
                    return null;
                }
                return option.text;
            }
            });
            $('.filter-tahun-barang').on('change', function(){
            console.log(filterTahunBarang = $(this).val())
            searchBarang()
            })

            $('.filter-unit-barang').select2({
            placeholder:'Unit Barang',
            allowClear:true,
            templateResult: function(option) {
                if(option.element && (option.element).hasAttribute('hidden')){
                    return null;
                }
                return option.text;
            }
            });
            $('.filter-unit-barang').on('change', function(){
            console.log(filterUnitBarang = $(this).val())
            searchBarang()
            })
        })      

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

        document.addEventListener('click', (e)=>{
            var dropdown = document.getElementById('dropdown')
            // var search2 = document.getElementsByClassName('select2-search__field')[0]
            if(!(dropdown.contains(e.target))){
                dropdown.removeAttribute('open')
            }
        })

        function exportDocument(){
            var stock_take_id = "{{$stock_take_id}}"
            axios({
                url: '{{url("/export_stock_take")}}',
                method: 'GET',
                responseType: 'blob',
                params: {
                    stock_take_id: "{{$stock_take_id}}",
                    mgr_general_affair: document.getElementById('mgr_general_affair').value? document.getElementById('mgr_general_affair').value:'',
                    vp_corporate_office: document.getElementById('vp_corporate_office').value? document.getElementById('vp_corporate_office').value:'',
                    svp_corporate_secretary: document.getElementById('svp_corporate_secretary').value? document.getElementById('svp_corporate_secretary').value:''
                }
            })
            .then((response) => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', `StockTake-${stock_take_id}.pdf`); // Nama file yang akan diunduh
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            })
            .catch((error) => {
                console.error('Error downloading PDF:', error);
            });
        }

        function searchBarang(){
            axios.get("{{url('/search_asset')}}", {
                params:{
                    path: 'stock_take_detail',
                    sort: sort_asc==true? 'asc':'desc',
                    jenis_barang: filterJenisBarang,
                    tahun_barang: filterTahunBarang,
                    unit_barang: filterUnitBarang,
                    barang: searchText,
                    stock_take_id: '{{$stock_take_id}}'
                }
            }).then((res)=>{
                console.log(res)
                document.getElementById('asset_table').innerHTML = res.data.view
            }).catch((res)=>{
                console.log(res)
            })
        }

        function sortJenisBarang(){
            sort_asc = !sort_asc

            searchBarang()
        }

        function changePage(url){
            console.log(url)
            axios.get(url, {
                params:{
                    path: 'stock_take_detail',
                    sort: sort_asc==true? 'asc':'desc',
                    jenis_barang: filterJenisBarang,
                    tahun_barang: filterTahunBarang,
                    unit_barang: filterUnitBarang,
                    barang: searchText,
                    stock_take_id: '{{$stock_take_id}}'
                }
            }).then((res)=>{
                console.log(res)
                document.getElementById('asset_table').innerHTML = res.data.view
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
    <script text="text/javascript">
        document.querySelectorAll('.detail-button').forEach(button => {
            button.addEventListener('click', function() {
                const url = this.getAttribute('data-url');
                window.location.href = url;
            });
        });
    </script>
</x-head>
    