<x-head title='{{$title}}'>
    <body class="flex flex-col min-w-screen min-h-screen overflow-auto bg-[#FBF6F0] overflow-auto">
        <x-navbar />
        <div class='flex flex-col h-fit max-md:min-h-screen w-full px-[5%] md:px-[10%] py-10'>
            <div class='flex max-md:flex-col md:items-end md:justify-between mb-4 xl:container 2xl:mx-auto'>
                <div class='max-md:mb-4'>
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
                            <a href={{url('/dashboard/'.$asset_data->jenis_barang)}} class="flex items-center text-xs text-slate-500 font-semibold hover:text-green-aida focus:outline-none focus:text-green-aida" href="#">
                                {{ucfirst($asset_data->jenis_barang)}} Category
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-point-filled mx-1" width="5" height="5" viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 7a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" stroke-width="0" fill="currentColor" />
                            </svg>
                        </li>
                        <li class="inline-flex items-center">
                            <a href={{url('/dashboard/'.$asset_data->jenis_barang.'/'.$asset_data->tipe_barang)}} class="flex items-center text-xs text-slate-500 font-semibold hover:text-green-aida focus:outline-none focus:text-green-aida" href="#">
                                {{ucfirst($asset_data->tipe_barang)}}
                            </a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-point-filled mx-1" width="5" height="5" viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 7a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" stroke-width="0" fill="currentColor" />
                            </svg>
                        </li>
                        <li class="inline-flex items-center">
                            <p class="flex items-center text-xs text-slate-400">
                                {{$asset_data->id_barang}}
                            </p>
                        </li>
                    </ol>
                </div>
                <div class='flex w-full justify-end'>
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
            <div class='flex max-md:flex-col w-full md:h-[350px] gap-5 mb-7 xl:container 2xl:mx-auto'>
                <div class='grid max-md:grid-rows-1 max-md:grid-cols-2 grid-rows-2 gap-8 max-md:w-full w-1/4 h-full'>
                    <div class='flex max-md:flex-col items-center justify-between h-full w-full rounded-lg bg-white p-5'>
                        <p class="inline-flex h-full items-start text-lg max-md:text-md font-bold mb-5">Foto Barang</p>
                        <div class='relative w-[100px] h-[100px] border-2 border-[#FBF6F0] rounded-md cursor-pointer' data-hs-overlay="#hs-vertically-centered-modal">
                            <img id='imageMainPreview' class="object-contain w-full h-full" src="{{asset('/assets/gambar_barang/'.$asset_data->gambar_barang)}}" alt="Asset Image">
                        </div>
                    </div>
                    <div class='flex max-md:flex-col items-center justify-between h-full w-full rounded-lg bg-white p-5'>
                        <div class='flex flex-col h-full max-md:mb-2'>
                            <p class="text-lg font-bold">QR Barang</p>
                            <p class="text-md text-gray-400 font-semibold">{{$asset_data->id_barang}}</p>
                        </div>                        
                        <div id='qr_barang' class='w-[100px] h-[100px] border-2 border-[#FBF6F0] rounded-md'>
                        </div>
                    </div>
                </div>                
                <div class='grow h-full rounded-lg bg-white p-5 grid grid-cols-3 max-md:grid-cols-2 gap-10 max-md:gap-5'>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Jenis Barang</p>
                        <input id='jenis_barang' type="text" value='{{ucwords($asset_data->jenis_barang)}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Tipe Barang</p>
                        <input id='tipe_barang' type="text" value='{{ucwords($asset_data->tipe_barang)}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Kode Barang</p>
                        <input id='kode_barang' type="text" value='{{$asset_data->id_barang}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Quantity</p>
                        <input id='quantity_barang' type="text" value='{{$asset_data->quantity_barang}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Merk</p>
                        <input id='merk_barang' type="text" value='{{ucwords($asset_data->merk_barang)}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Lantai</p>
                        <input id='lantai_barang' type="text" value='{{$asset_data->lantai_barang}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Ruangan</p>
                        <input id='ruangan_barang' type="text" value='{{ucwords($asset_data->ruangan_barang)}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Tahun</p>
                        <input id='tahun_barang' type="text" value='{{$asset_data->tahun_barang}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full'>
                        <p class='text-sm text-slate-400 mb-2'>Unit</p>
                        <input id='unit_barang' type="text" value='{{$asset_data->unit_barang}}' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                </div>
            </div>
            <div class='flex w-full justify-end xl:container 2xl:mx-auto'>
                <div class="flex gap-2">
                    <a onclick="window.history.back()">
                        <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm rounded-lg border border-transparent bg-slate-100 text-black hover:bg-slate-200 disabled:opacity-50 disabled:pointer-events-none">
                            Cancel
                        </button>
                    </a>
                    <button type="button" onclick='updateBarang()' class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                        Update
                    </button>
                </div>
            </div>
        </div>
        <div id="hs-vertically-centered-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                        <h3 class="font-bold text-gray-800 dark:text-white">
                        Pratinjau/Edit Gambar
                        </h3>
                        <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#hs-vertically-centered-modal">
                        <span class="sr-only">Close</span>
                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18"></path>
                            <path d="m6 6 12 12"></path>
                        </svg>
                        </button>
                    </div>
                <div class="flex flex-col p-4 overflow-y-auto">
                    <div class='flex items-center justify-center w-full h-fit min-h-32 p-4 border-2 border-slate-300 border-dashed mb-5'>
                        <img id="imagePreview" src="" alt="Pratinjau Gambar" class='z-50 '/>
                    </div>
                    <div class='w-full min-h-'>
                        <p class='flex text-xs text-slate-400'>Pilih Gambar</p>
                        <form>
                            <label for="small-file-input" class="sr-only">Choose file</label>
                            <input type="file" accept=".jpg, .jpeg, .png" name="small-file-input" id="input_gambar" class="block w-full md:w-[450px] border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none
                            file:bg-green-100 file:border-0
                            file:text-green-aida
                            file:me-4
                            file:py-2 file:px-4">
                        </form>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                    <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800" data-hs-overlay="#hs-vertically-centered-modal">
                        Close
                    </button>
                    <button type="button" onclick='updateGambar()' class="py-2 px-3 min-w-[100px] inline-flex items-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-vertically-centered-modal">
                        Simpan Gambar
                    </button>
                </div>
                </div>
            </div>
        </div>       
    </body>
    <script type='text/javascript'>
        document.getElementById('imagePreview').src="{{asset('/assets/gambar_barang/'.$asset_data->gambar_barang)}}"
        new QRCode(document.getElementById('qr_barang'), "{{url()->current()}}")

        var file
        document.getElementById('input_gambar').addEventListener('change', function(event){
            file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.getElementById('imagePreview');
                    img.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        })
        function updateGambar(){
            var reader = new FileReader()
            reader.onload = function(e) {
                var img = document.getElementById('imageMainPreview');
                img.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }

        function updateBarang(){
            axios.post("{{url('/update_asset')}}", {
                id: {{$asset_data->id}},
                jenis_barang: (document.getElementById("jenis_barang").value).toLowerCase(),
                tipe_barang: (document.getElementById("tipe_barang").value).toLowerCase(),
                kode_barang: document.getElementById("kode_barang").value,
                quantity_barang: document.getElementById("quantity_barang").value,
                merk_barang: document.getElementById("merk_barang").value,
                lantai_barang: document.getElementById("lantai_barang").value,
                ruangan_barang: document.getElementById("ruangan_barang").value,
                tahun_barang: document.getElementById("tahun_barang").value,
                unit_barang: document.getElementById("unit_barang").value,
                gambar_barang: document.getElementById('input_gambar').files[0]
            },{
                headers:{
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((res)=>{
                console.log(res)
                swal.fire({
                    title:'Data Berhasil Diperbaharui',
                    icon: 'success',
                    text:`Data yang Anda Perbaharui Berhasil Tersimpan`,
                    confirmButtonColor: "#17C653",
                })
            })
            .catch((err)=>{
                console.log(err)
                swal.fire({
                    title:'Silahkan Lengkapi Data!',
                    icon: 'warning',
                    text:`Silahkan Lengkapi Seluruh Kolom Berbintang Merah!`,
                    confirmButtonColor: "#facc15",
                })
            })
        } 
    </script>
</x-head>