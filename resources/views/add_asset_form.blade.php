<x-head title='{{$title}}'>
    <style>
        .select2-container--default.select2-container--disabled .select2-selection--single {
            background-color: #e0e0e0;
            color: #a0a0a0;
            cursor: not-allowed;
        }

        .select2-container--default.select2-disabled .select2-selection--multiple {
            background-color: #e0e0e0;
            color: #a0a0a0;
            cursor: not-allowed;
        }
    </style>
    <body class="flex flex-col min-w-screen min-h-screen overflow-auto bg-[#FBF6F0] overflow-auto">
        <x-navbar />
        <div class='flex flex-col h-fit w-full px-[5%] md:px-[10%] py-10'>
            <div class='mb-4 xl:container 2xl:mx-auto'>
                <p class="text-lg font-bold mb-1">New Asset</p>
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
                        <a href={{url('/dashboard/assets')}} class="flex items-center text-xs text-slate-500 font-semibold hover:text-green-aida focus:outline-none focus:text-green-aida" href="#">
                            Assets
                        </a>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-point-filled mx-1" width="5" height="5" viewBox="0 0 24 24" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 7a5 5 0 1 1 -4.995 5.217l-.005 -.217l.005 -.217a5 5 0 0 1 4.995 -4.783z" stroke-width="0" fill="currentColor" />
                        </svg>
                    </li>
                    <li class="inline-flex items-center">
                        <p class="flex items-center text-xs text-slate-400">
                            New Asset 
                        </p>
                    </li>
                </ol>
            </div>
            <div class='mb-7 xl:container 2xl:mx-auto'>
                <div class="flex items-center w-fit bg-green-100 border border-dashed border-green-aida text-sm rounded-lg px-2 py-2 gap-2" role="alert">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle stroke-green-aida" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                            <path d="M12 9h.01" />
                            <path d="M11 12h1v4h1" />
                        </svg>
                    </span> 
                    <p>Asset Baru yang Ditambahkan Akan Otomatis <span class='text-green-aida'>Generate QR Baru</span></p>
                </div>
            </div>            
            <div class='flex max-md:flex-col w-full md:h-[350px] gap-5 mb-7 xl:container 2xl:mx-auto'>
                <div class='max-md:w-full w-1/4 h-full rounded-lg bg-white p-5'>
                    <p class="text-lg font-bold mb-5">Foto Barang</p>
                    <div class='flex flex-col w-full items-center'>
                        <div class='relative flex items-center justify-center w-[180px] h-[180px] shadow-[0_0_30px_0px_rgba(0,0,0,0.1)] rounded-lg mb-5 cursor-pointer'>
                            <img src="{{asset('assets/photo_library.svg')}}" id='imageDummy' alt="Image Album" class='w-[80px] h-auto'>
                            <img id="imageMainPreview" src="" alt="Pratinjau Gambar" class='w-full h-auto hidden'/>
                            <div class='absolute flex items-center justify-center bg-white -top-2 -right-2 z-10 rounded-full w-8 h-8 shadow-[0_0_21px_6px_rgba(0,0,0,0.1)]' data-hs-overlay="#hs-vertically-centered-modal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil w-5 h-auto stroke-slate-400" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" />
                                    <path d="M13.5 6.5l4 4" />
                                </svg>
                            </div>
                            <div class="hs-overlay hidden size-full fixed top-0 start-0 z-[100] overflow-x-hidden overflow-y-auto pointer-events-none">
                                <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-14 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                                    <div class="flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                                    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                                        <h3 class="font-bold text-gray-800 dark:text-white">
                                        Modal title
                                        </h3>
                                        <button type="button" class="hs-dropup-toggle flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#hs-slide-up-animation-modal">
                                        <span class="sr-only">Close</span>
                                        <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M18 6 6 18"></path>
                                            <path d="m6 6 12 12"></path>
                                        </svg>
                                        </button>
                                    </div>
                                    <div class="p-4 overflow-y-auto">
                                        <p class="mt-1 text-gray-800 dark:text-neutral-400">
                                        This is a wider card with supporting text below as a natural lead-in to additional content.
                                        </p>
                                    </div>
                                    <div class="flex justify-end items-center gap-x-2 py-3 px-4 border-t dark:border-neutral-700">
                                        <button type="button" class="hs-dropup-toggle py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800" data-hs-overlay="#hs-slide-up-animation-modal">
                                        Close
                                        </button>
                                        <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                        Save changes
                                        </button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class='text-sm text-slate-400 text-center mb-2'>Hanya File Berformat *.png, *.jpg, dan *.jpeg yang Diterima</p>
                    </div>
                </div>
                <div class='grow h-full rounded-lg bg-white p-5 grid max-md:grid-cols-2 grid-cols-12 max-md:gap-5 gap-10'>
                    <div class='w-full md:col-span-4'>
                        <p class='text-sm text-justify text-slate-400 mb-2'>Jenis Barang<span class='text-red-500'>*</span></p>
                        <!-- Nanti dijadikan dinamis kalau benar-benar kategori bisa nambah -->
                        <select placeholder='Jenis Barang' class="jenis-barang w-full h-full text-sm py-3 px-4 focus:ring-green-aida border-0 bg-[#FBF6F0] rounded-lg cursor-pointer" name="" id="" style="width: 100%">
                            <option></option>
                            <option value='meubelair'>Meubelair</option>
                            <option value='electronic'>Electronic</option>
                            <option value='other'>Other</option>                                   
                        </select>
                        <!-- <select id='jenis_barang' class="py-3 px-4 pe-9 block w-full bg-slate-100 border-0 rounded-lg text-sm focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                            <option></option>
                            <option value='meubelair'>Meubelair</option>
                            <option value='electronic'>Electronic</option>
                            <option value='other'>Other</option>
                        </select> -->
                    </div>
                    <div class='w-full md:col-span-4'>
                        <p class='text-sm text-slate-400 mb-2'>Tipe Barang<span class='text-red-500'>*</span></p>
                        <input type="text" id='tipe_barang' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full md:col-span-4'>
                        <p class='text-sm text-slate-400 mb-2'>Seri Barang</p>
                        <input type="text" id='seri_barang' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full md:col-span-4'>
                        <p class='text-sm text-slate-400 mb-2'>Quantity</p>
                        <input type="number" id='quantity_barang' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full md:col-span-4'>
                        <p class='text-sm text-slate-400 mb-2'>Merk</p>
                        <input type="text" id='merk_barang' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full md:col-span-4'>
                        <p class='text-sm text-slate-400 mb-2'>Lantai<span class='text-red-500'>*</span></p>
                        <input type="number" id='lantai_barang' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full md:col-span-3'>
                        <p class='text-sm text-slate-400 mb-2'>Ruangan<span class='text-red-500'>*</span></p>
                        <input type="text" id='ruangan_barang' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full md:col-span-3'>
                        <p class='text-sm text-slate-400 mb-2'>Tahun</p>
                        <input type="number" id='tahun_barang' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none">
                    </div>
                    <div class='w-full md:col-span-3'>
                        <p class='text-sm text-slate-400 mb-2'>Unit<span class='text-red-500'>*</span></p>
                        <!-- <input type="text" id='unit_barang' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none"> -->
                        <select placeholder='Unit' class="unit-barang w-full h-full text-sm py-3 px-4 focus:ring-green-aida border-0 bg-[#FBF6F0] rounded-lg cursor-pointer" name="" id="" style="width: 100%">
                            <option></option>
                            @foreach($unit_list as $unit)
                                <option value='{{$unit->nama_unit}}'>{{ucfirst($unit->nama_unit)}}</option>
                            @endforeach                                   
                        </select>
                    </div>
                    <div class='w-full md:col-span-3'>
                        <p class='text-sm text-slate-400 mb-2'>Regional<span class='text-red-500'>*</span></p>
                        <!-- <input type="text" id='unit_barang' class="py-3 px-4 block w-full bg-slate-100 rounded-lg text-sm border-0 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none"> -->
                        <select placeholder='Regional' class="regional-barang w-full h-full text-sm py-3 px-4 focus:ring-green-aida border-0 bg-[#FBF6F0] rounded-lg cursor-pointer disabled:bg-[#FBF6F0]" name="" id="" style="width: 100%">
                            <option></option>
                            @foreach($regional_list as $regional)
                                <option value='{{$regional->regional}}'>{{$regional->regional}}</option>
                            @endforeach                                   
                        </select>
                    </div>
                </div>
            </div>
            <div class='flex w-full justify-end xl:container 2xl:mx-auto'>
                <div class="flex gap-2">
                    <button onclick='window.history.back();' type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm rounded-lg border border-transparent bg-slate-100 text-black hover:bg-slate-200 disabled:opacity-50 disabled:pointer-events-none">
                        Cancel
                     </button>
                    <button type="button" onclick="add_asset()" class="py-2 px-3 min-w-[100px] inline-flex items-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                        + Add Asset
                    </button>
                </div>
            </div>
        </div>
        <div id="hs-vertically-centered-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none">
            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
                <div class="w-full flex flex-col bg-white border shadow-sm rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
                        <h3 class="font-bold text-gray-800 dark:text-white">
                        Upload Gambar
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
                        <img id="imagePreview" src="" alt="Pratinjau Gambar" class='z-50 hidden'/>
                        <div id='text_preview' class='text-slate-300 z-0'>Preview Gambar Anda</div>
                    </div>
                    <div class='w-full min-h-'>
                        <p class='flex text-xs text-slate-400'>Pilih Gambar</p>
                        <form>
                            <label for="small-file-input" class="sr-only">Choose file</label>
                            <input type="file" accept=".jpg, .jpeg, .png" name="small-file-input" id="input_gambar" class="block max-md:w-full w-[450px] border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none
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
                    <button type="button" onclick='save_image()' class="py-2 px-3 min-w-[100px] inline-flex items-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none" data-hs-overlay="#hs-vertically-centered-modal">
                        Simpan Gambar
                    </button>
                </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript">
        var unit_barang
        var jenis_barang
        var regional_barang
        var user_unit = '{!!session("user")->privilage["view"]["unit"]!!}'
        var user_regional = '{{session("user")->privilage["view"]["regional"]}}'
        console.log(user_unit)


        $(document).ready(function(){
            $('.jenis-barang').select2({
            templateResult: function(option) {
                if(option.element && (option.element).hasAttribute('hidden')){
                    return null;
                }
                return option.text;
            }
            });
            $('.jenis-barang').on('change', function(){
                jenis_barang =  $(this).val()
            })
            $('.unit-barang').select2({
            templateResult: function(option) {
                if(option.element && (option.element).hasAttribute('hidden')){
                    return null;
                }
                return option.text;
            }
            });
            $('.unit-barang').on('change', function(){
                unit_barang =  $(this).val()
                console.log(unit_barang)
            })
            $('.regional-barang').select2({
            templateResult: function(option) {
                if(option.element && (option.element).hasAttribute('hidden')){
                    return null;
                }
                return option.text;
            }
            });
            $('.regional-barang').on('change', function(){
                regional_barang =  $(this).val()
                console.log(regional_barang)
            })

            // Jika bukan CO
            if(user_unit!='all'){
                $('.unit-barang').val(user_unit).trigger('change')
                $('.regional-barang').val(user_regional).trigger('change')
            }
        })


        var file
        document.getElementById('input_gambar').addEventListener('change', function(event){
            file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.getElementById('imagePreview');
                    var text = document.getElementById('text_preview');
                    img.src = e.target.result;
                    img.style.display = 'block';
                    text.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        })
    </script>
    <script type="text/javascript">
        function save_image(){
            var reader = new FileReader()
            reader.onload = function(e) {
                var img = document.getElementById('imageMainPreview');
                var imgDummy = document.getElementById('imageDummy');
                img.src = e.target.result;
                img.style.display = 'block';
                imgDummy.style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
        function add_asset(){
            axios.post("{{url('/add_asset')}}", {
                jenis_barang: jenis_barang.toLowerCase(),
                tipe_barang: (document.getElementById("tipe_barang").value).toLowerCase(),
                seri_barang: document.getElementById("seri_barang").value,
                quantity_barang: document.getElementById("quantity_barang").value,
                merk_barang: document.getElementById("merk_barang").value,
                lantai_barang: document.getElementById("lantai_barang").value,
                ruangan_barang: document.getElementById("ruangan_barang").value,
                tahun_barang: document.getElementById("tahun_barang").value,
                unit_barang: unit_barang,
                regional_barang: regional_barang,
                gambar_barang: document.getElementById('input_gambar').files[0]
            },{
                headers:{
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((res)=>{
                console.log(res)
                swal.fire({
                    title:'Data Berhasil Tersimpan',
                    icon: 'success',
                    text:`Data yang Anda Inputkan Berhasil Tersimpan`,
                    confirmButtonColor: "#17C653",
                }).then((res)=>{
                    window.location.replace("{{url('/assets/add_asset')}}")
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
    <!-- Tampilan select2 -->
     <script type='text/javascript'>
        $(document).ready(function(){
            $('<link rel="stylesheet" href="{{asset('css/select2_form.css')}}" />').appendTo('head')
        })
     </script>
</x-head>