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
                <p class="text-lg font-bold mb-1">Add Stock Take</p>
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
                            Add Stock Take
                        </p>
                    </li>
                </ol>
            </div>
            <div class='flex flex-col max-md:h-full h-fit min-h-[850px] w-full rounded-lg bg-white p-5 mb-5 md:container md:mx-auto'>                                
                <div class='flex max-md:flex-col w-full sm:justify-between mb-5'>
                    <!-- <md -->
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
                        <a href="{{url('/export_asset')}}">
                            <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm max-sm:text-xs rounded-lg border border-transparent bg-green-100 text-green-aida hover:bg-green-200 disabled:opacity-50 disabled:pointer-events-none">
                                Export
                            </button>                            
                        </a>
                        <a href="{{url('/assets/add_asset')}}">
                            <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center gap-x-2 text-sm max-sm:text-xs rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                                + Add Asset
                            </button>
                        </a>
                    </div>
                    <!-- >md -->
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
                                <select placeholder='Status Approval' class="filter-status-approval w-full text-sm py-1 px-2 focus:ring-green-aida border-0 bg-[#FBF6F0] rounded-lg cursor-pointer" name="" id="">
                                    <option></option>
                                    <option value='true'>Approved</option>
                                    <option value='false'>Rejected</option>
                                    <option value='ny'>NY Approved</option>                                
                                </select>
                            </div>
                        </details>
                        <button type="button" onclick='newStockTake()' class="py-2 px-3 min-w-[100px] inline-flex items-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                            + New Stock Take
                        </button>
                    </div>
                </div>
                <div id='asset_table' class='grow flex flex-col justify-between w-full h-full'>
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
        var filterTahunBarang = ''
        var filterJenisBarang = ''
        var filterUnitBarang = ''
        var filterStatusApproval = ''
        var searchText = ''
        var sort_asc = true

        searchBarang()

        //JQuery select2
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

            $('.filter-status-approval').select2({
            placeholder:'Status Approval',
            allowClear:true,
            templateResult: function(option) {
                if(option.element && (option.element).hasAttribute('hidden')){
                    return null;
                }
                return option.text;
            }
            });
            $('.filter-status-approval').on('change', function(){
            filterStatusApproval = $(this).val()
            console.log(filterStatusApproval)
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
    
        function clickCheckbox(idBarang){
            // console.log(idBarang)
            axios.post('{{url("/click_checkbox")}}', {
                id: idBarang
            }).then((res)=>{
                console.log(res)
            })
        }

        function searchBarang(){
            axios.get("{{url('/search_asset')}}", {
                params:{
                    path: 'add_stock_take',
                    sort: sort_asc==true? 'asc':'desc',
                    jenis_barang: filterJenisBarang,
                    tahun_barang: filterTahunBarang,
                    unit_barang: filterUnitBarang,
                    status_approval: filterStatusApproval,
                    barang: searchText
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
                    path:'add_stock_take',
                    sort: sort_asc==true? 'asc':'desc',
                    jenis_barang: filterJenisBarang,
                    tahun_barang: filterTahunBarang,
                    unit_barang: filterUnitBarang,
                    status_approval: filterStatusApproval,
                    barang: searchText
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
        
        function newStockTake(){
           axios.get('{{url("/get_selected_asset")}}').then((res)=>{
                if(res.data.length==0){
                    swal.fire({
                        title:'Silahkan Pilih Asset',
                        icon: 'warning',
                        text:`Silahkan Pilih Asset Apa Saja yang Ingin Anda Masukkan ke Stock Take!`,
                        confirmButtonColor: "#facc15",
                    })
                    return
                }

                swal.fire({
                        title:'Apakah Anda Yakin?',
                        icon: 'question',
                        html:`<div style="font-size:16px">Apakah Anda Yakin Untuk Menambahkkan</br><b>${res.data.length} Asset</b> ke Stock Take?</br>Anda Tidak Bisa Mengurungkan Keputusan Anda!</div>`,
                        width:'500px',
                        showCancelButton: true,
                        cancelButtonColor: "#d33",
                        confirmButtonColor: "#17C653",
                        confirmButtonText: "Lanjutkan"
                    }).then((res)=>{
                        if(res.isConfirmed){
                            axios.post('{{url("/new_stock_take")}}', {
                                selected_asset: res.data
                            },{
                                headers: {
                                    'Content-Type': 'application/json'
                                }
                            }).then((res)=>{
                                var stock_take_id = res.data.stock_take_id
                                swal.fire({
                                    title:'Stock Take Berhasil Ditambahkan',
                                    icon: 'success',
                                    text:`Stock Take Berhasil Ditambahkan dengan ID Stock Take: ${stock_take_id}`,
                                    confirmButtonColor: "#17C653",
                                }).then((res)=>{
                                    if(res.isConfirmed){
                                        var baseURL = "{{url('/stock_take')}}"
                                        window.location.replace(`${baseURL}/${stock_take_id}`)
                                    }
                                })
                            })
                        }
                    })
           })           
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
    