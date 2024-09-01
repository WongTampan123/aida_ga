<x-head title='{{$title}}'>
    <body class="flex flex-col min-w-screen min-h-screen overflow-auto bg-[#FBF6F0] overflow-auto">
        <x-navbar />
        <div class='flex flex-col h-fit w-full px-[10%] py-10'>
            <div class='mb-4 xl:container 2xl:mx-auto'>
                <p class="text-lg font-bold mb-1">Bulk Upload Asset</p>
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
                            Bulk Upload
                        </p>
                    </li>
                </ol>
            </div>
            <div class='mb-4 xl:container 2xl:mx-auto'>
                <div class="flex items-center w-fit bg-green-100 border border-dashed border-green-aida text-sm rounded-lg px-2 py-2 gap-2" role="alert">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-info-circle stroke-green-aida" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                            <path d="M12 9h.01" />
                            <path d="M11 12h1v4h1" />
                        </svg>
                    </span> 
                    <p>Silahkan Download Template <span class='text-green-aida cursor-pointer'><a href="{{url('/download_template')}}">Disini</a></span> dan Sesuaikan Data yang Ingin Diunggah </p>
                </div>
            </div>       
            <div class='flex w-full h-[350px] gap-5 mb-7 xl:container 2xl:mx-auto'>
                <div class='relative flex justify-between items-center w-full h-full rounded-lg bg-white py-5 px-8'>
                    <div class="absolute top-5 left-8 flex">
                        <div class="flex bg-gray-100 hover:bg-gray-200 rounded-lg transition p-1">
                            <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                                <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-green-aida py-2 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-green-aida focus:outline-none focus:text-green-aida font-medium rounded-lg hover:hover:text-green-aida disabled:opacity-50 disabled:pointer-events-none active" id="segment-item-1" aria-selected="true" data-hs-tab="#segment-1" aria-controls="segment-1" role="tab">
                                    Upload Excel
                                </button>
                                <button type="button" class="hs-tab-active:bg-white hs-tab-active:text-green-aida py-2 px-4 inline-flex items-center gap-x-2 bg-transparent text-sm text-gray-500 hover:text-green-aida focus:outline-none focus:text-green-aida font-medium rounded-lg hover:hover:text-green-aida disabled:opacity-50 disabled:pointer-events-none" id="segment-item-2" aria-selected="false" data-hs-tab="#segment-2" aria-controls="segment-2" role="tab">
                                    Upload Gambar
                                </button>
                            </nav>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div id="segment-1" role="tabpanel" aria-labelledby="segment-item-1">
                            <p class='flex text-2xl font-semibold mb-4'>Upload File</p>
                            <p class='flex text-xs text-slate-400'>Hanya File Berformat *.xls dan *.xlsx yang Diterima</p>
                            <form enctype="multipart/form-data">
                                <label for="small-file-input" class="sr-only">Choose file</label>
                                <input type="file" accept=".xlsx" name="small-file-input" id="input_excel" class="block w-[450px] border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none
                                file:bg-green-100 file:border-0
                                file:text-green-aida
                                file:me-4
                                file:py-2 file:px-4">
                            </form>
                        </div>
                        <div id="segment-2" class="hidden" role="tabpanel" aria-labelledby="segment-item-2">
                            <p class='flex text-2xl font-semibold mb-4'>Upload Gambar</p>
                            <p class='flex text-xs text-slate-400'>Hanya File Berformat *.png, *.jpg, dan *.jpeg yang Diterima</p>
                            <form enctype="multipart/form-data">
                                <label for="small-file-input" class="sr-only">Choose file</label>
                                <input type="file" accept=".jpg, .jpeg, .png" name="small-file-input" id="input_gambar" multiple class="block w-[450px] border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none
                                file:bg-green-100 file:border-0
                                file:text-green-aida
                                file:me-4
                                file:py-2 file:px-4">
                            </form>
                        </div>
                    </div>
                    <div class='w-auto h-full'>
                        <img class="object-contain w-full h-full" src="{{asset('/assets/bulk_upload.svg')}}" alt="Asset Image">
                    </div>
                </div>
            </div>
            <div class='flex w-full justify-end xl:container 2xl:mx-auto'>
                <div class="flex gap-2">
                    <button onclick='bulkUpload()' type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                        Save 
                    </button>
                </div>
            </div>
        </div>        
    </body>
    <script type='text/javascript'>
        function bulkUpload(){
            if(document.getElementById('input_excel').files[0]){
                console.log(document.getElementById('input_excel').files)
                axios.post('{{url("/save_bulk_upload")}}', {
                    'file_excel': document.getElementById('input_excel').files[0]
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
                    })
                    return
                }).catch((res)=>{
                    console.log(res)
                    swal.fire({
                        title:'Silahkan Lengkapi Data!',
                        icon: 'warning',
                        text:`Silahkan Lengkapi Seluruh Kolom Berbintang Merah!`,
                        confirmButtonColor: "#facc15",
                    })
                    return
                })
            }
            if(document.getElementById('input_gambar').files[0]){
                console.log(document.getElementById('input_gambar').files)
                axios.post('{{url("/save_image_bulk_upload")}}', {
                    'file_gambar': document.getElementById('input_gambar').files
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
                    })
                    return
                }).catch((res)=>{
                    console.log(res)
                    swal.fire({
                        title:'Silahkan Lengkapi Data!',
                        icon: 'warning',
                        text:`Silahkan Lengkapi Seluruh Kolom Berbintang Merah!`,
                        confirmButtonColor: "#facc15",
                    })
                    return
                })
            }
            if(document.getElementById('input_excel').files.length==0 && document.getElementById('input_gambar').files.length==0){
                swal.fire({
                    title:'Silahkan Lengkapi Data!',
                    icon: 'warning',
                    text:`Silahkan Pilih File yang Ingin Diunggah!`,
                    confirmButtonColor: "#facc15",
                })
            }
        }
    </script>
</x-head>