@php
    header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: Fri, 01 Jan 1990 00:00:00 GMT');

    $user = Session::get('user');
@endphp
<x-head title={{$title}}>
    <body class="flex flex-col min-w-screen overflow-auto bg-[#FBF6F0] overflow-auto">
        <x-navbar />
        <div class='flex flex-col min-h-screen w-full px-[5%] py-10'>
            <div class='mb-5 md:container md:mx-auto'>
                <p class="text-lg font-bold mb-1">Asset</p>
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
                            Asset
                        </p>
                    </li>
                </ol>
            </div>
            <div class='flex flex-col max-md:h-full h-fit min-h-[850px] w-full rounded-lg bg-white p-5 mb-5 md:container md:mx-auto'>                                
                <div class='flex max-md:flex-col w-full sm:justify-between mb-5'>
                    <div class="flex max-2xs:grid-cols-3 max-md:justify-end max-sm:justify-center gap-2 max-md:mb-4 md:hidden">
                        <details id='dropdown' class="dropdown">
                            <summary class="py-2 px-3 max-2xs:w-full 2xs:min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm max-sm:text-xs rounded-lg border border-transparent bg-green-100 text-green-aida hover:bg-green-200 disabled:opacity-50 disabled:pointer-events-none cursor-pointer">
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
                                <select placeholder='Unit Barang' class="filter-unit-barang w-full text-sm py-1 px-2 focus:ring-green-aida border-0 bg-[#FBF6F0] rounded-lg cursor-pointer" name="" id="">
                                    <option></option>
                                    @foreach($unit_barang_list as $unit_barang)
                                        <option value='{{$unit_barang->nama_unit}}'>{{ucfirst($unit_barang->nama_unit)}}</option>
                                    @endforeach                                   
                                </select>
                                <select placeholder='Kondisi Barang' class="filter-kondisi-barang w-full text-sm py-1 px-2 focus:ring-green-aida border-0 bg-[#FBF6F0] rounded-lg cursor-pointer" name="" id="">
                                    <option></option>
                                    <option value='true'>Bagus</option>
                                    <option value='false'>Rusak</option>                               
                                </select>
                                <select placeholder='Status Approval' class="filter-status-approval w-full text-sm py-1 px-2 focus:ring-green-aida border-0 bg-[#FBF6F0] rounded-lg cursor-pointer" name="" id="">
                                    <option></option>
                                    <option value='true'>Approved</option>
                                    <option value='false'>Rejected</option>
                                    <option value='ny'>NY Approved</option>                                
                                </select>
                                <div class='rounded-lg overflow-hidden flex justify-between items-center relative'>
                                    <input id="search_ruangan" type="text" placeholder="Search Ruangan" class="w-full focus:outline-none focus:ring-0 border-0 py-0.5 px-2 text-[14px] bg-[#F6F6F6]">
                                    <svg id="loading_2" class="animate-spin text-[#9AA1B7] absolute right-0 hidden" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                            </div>
                        </details>
                        <a href="{{url('/export_asset')}}">
                            <button type="button" class="py-2 px-3 max-2xs:w-full 2xs:min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm max-sm:text-xs rounded-lg border border-transparent bg-green-100 text-green-aida hover:bg-green-200 disabled:opacity-50 disabled:pointer-events-none">
                                Export
                            </button>                            
                        </a>
                        @if($user->privilage['create']=='true')
                            <a href="{{url('/assets/add_asset')}}">
                            <button type="button" class="py-2 px-3 max-2xs:w-full 2xs:min-w-[100px] inline-flex items-center gap-x-2 text-sm max-sm:text-xs rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                                + Add Asset
                            </button>
                            </a>                        
                        @endif
                        
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
                                <select placeholder='Kondisi Barang' class="filter-kondisi-barang w-full text-sm py-1 px-2 focus:ring-green-aida border-0 bg-[#FBF6F0] rounded-lg cursor-pointer" name="" id="">
                                    <option></option>
                                    <option value='true'>Bagus</option>
                                    <option value='false'>Rusak</option>                               
                                </select>
                                <select placeholder='Status Approval' class="filter-status-approval w-full text-sm py-1 px-2 focus:ring-green-aida border-0 bg-[#FBF6F0] rounded-lg cursor-pointer" name="" id="">
                                    <option></option>
                                    <option value='true'>Approved</option>
                                    <option value='false'>Rejected</option>
                                    <option value='ny'>NY Approved</option>                                
                                </select>
                                <div class='rounded-lg overflow-hidden flex justify-between items-center relative'>
                                    <input id="search_ruangan" type="text" placeholder="Search Ruangan" class="w-full focus:outline-none focus:ring-0 border-0 py-0.5 px-2 text-[14px] bg-[#F6F6F6]">
                                    <svg id="loading_2" class="animate-spin text-[#9AA1B7] absolute right-0 hidden" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                </div>
                            </div>
                        </details>
                        <a href="{{url('/export_asset')}}">
                            <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-100 text-green-aida hover:bg-green-200 disabled:opacity-50 disabled:pointer-events-none">
                                Export
                            </button>
                        </a>
                        @if($user->privilage['create']=='true')
                            <a href="{{url('/assets/add_asset')}}">
                                <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                                    + Add Asset
                                </button>
                            </a>
                        @endif
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
        var searchRuangan = document.getElementById('search_ruangan')
        var filterJenisBarang = params.get('jenis_barang')? params.get('jenis_barang'):''
        var filterTahunBarang = ''
        var filterUnitBarang = ''
        var filterKondisiBarang = ''
        var filterStatusApproval = ''
        var searchText = ''
        var searchTextRuangan = ''
        var sort_asc = true

        
        if(filterJenisBarang != ''){
            document.getElementById(`${filterJenisBarang}`).setAttribute("selected","selected")
        }

        searchBarang()
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
            if(filterJenisBarang!=''){
                $('.filter-jenis-barang').val(filterJenisBarang).trigger('change');
            }
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

            var unit = "{{session('user')->privilage['view']['unit']!='all'? session('user')->id_unit_sppd:'Unit Barang'}}".replace(/&amp;/g, '&')
            $('.filter-unit-barang').select2({
            placeholder: unit,
            allowClear:true,
            templateResult: function(option) {
                if(option.element && (option.element).hasAttribute('hidden')){
                    return null;
                }
                return option.text;
            }
            });
            if (unit != 'Unit Barang') {
                $('.filter-unit-barang').prop('disabled', true);  // Disable Select2
            }
            $('.filter-unit-barang').on('change', function(){
            console.log(filterUnitBarang = $(this).val())
            searchBarang()
            })

            $('.filter-kondisi-barang').select2({
            placeholder:'Kondisi Barang',
            allowClear:true,
            templateResult: function(option) {
                if(option.element && (option.element).hasAttribute('hidden')){
                    return null;
                }
                return option.text;
            }
            });
            $('.filter-kondisi-barang').on('change', function(){
            filterKondisiBarang = $(this).val()
            console.log(filterKondisiBarang)
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
      

        searchRuangan.addEventListener('keyup', ()=>{
            document.getElementById('loading_2').classList.remove('hidden')
            clearTimeout(typingTimer)
            typingTimer = setTimeout(() => {           
                // axios.get("{{url('/search_user?input=')}}"+userSearch.value).then((res)=>{
                //   document.getElementById('user_table').innerHTML = res.data.view
                //   document.getElementById('loading').classList.add('hidden')
                // })
                searchTextRuangan = document.getElementById('search_ruangan').value
                searchBarang()
                document.getElementById('loading_2').classList.add('hidden')
            }, typingInterval);
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
            console.log(searchTextRuangan)
            axios.get("{{url('/search_asset')}}", {
                params:{
                    sort: sort_asc==true? 'asc':'desc',
                    jenis_barang: filterJenisBarang,
                    tahun_barang: filterTahunBarang,
                    unit_barang: filterUnitBarang,
                    status_approval: filterStatusApproval,
                    kondisi_barang: filterKondisiBarang,
                    barang: searchText,
                    ruangan: searchTextRuangan
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
    