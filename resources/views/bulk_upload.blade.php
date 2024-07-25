<x-head title='{{$title}}'>
    <body class="flex flex-col min-w-screen overflow-auto bg-[#FBF6F0] overflow-auto">
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
            <div class='flex w-full h-[350px] gap-5 mb-7 xl:container 2xl:mx-auto'>
                <div class='flex justify-between items-center w-full h-full rounded-lg bg-white py-5 px-8'>
                    <div>
                        <p class='flex text-2xl font-semibold mb-4'>Upload Files</p>
                        <p class='flex text-xs text-slate-400'>Select Files From Your Device (.xls or .xlsx)</p>
                        <form>
                            <label for="small-file-input" class="sr-only">Choose file</label>
                            <input type="file" name="small-file-input" id="small-file-input" class="block w-[450px] border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-green-aida focus:ring-green-aida disabled:opacity-50 disabled:pointer-events-none
                            file:bg-green-100 file:border-0
                            file:text-green-aida
                            file:me-4
                            file:py-2 file:px-4">
                        </form>
                    </div>
                    <div class='w-auto h-full'>
                        <img class="object-contain w-full h-full" src="{{asset('/assets/bulk_upload.svg')}}" alt="Asset Image">
                    </div>
                </div>
            </div>
            <div class='flex w-full justify-end xl:container 2xl:mx-auto'>
                <div class="flex gap-2">
                    <button type="button" class="py-2 px-3 min-w-[100px] inline-flex items-center justify-center gap-x-2 text-sm rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                        Save 
                    </button>
                </div>
            </div>
        </div>        
    </body>
</x-head>