<x-head title={{$title}}>
    <body class="relative flex flex-col h-screen min-w-screen overflow-auto bg-[#FBF6F0]">
        <x-navbar />
        <div class='grow max-h-[650.58px] w-full px-[10%] py-10'>
            <div class='h-full w-full grid grid-cols-6 grid-rows-2 gap-8 2xl:container 2xl:mx-auto 2xl:mb-auto'>
                <div class='w-full h-full flex flex-col p-6 justify-between col-span-3 rounded-lg bg-white drop-shadow-md'>
                    <div>
                        <p class='text-xl font-semibold'>Total Assets</p>
                        <p class='text-sm text-slate-400 font-normal'>All Managed Assets</p>
                    </div>
                    <div class='grow w-full flex justify-between'>
                        <div class='grow h-full flex flex-col justify-center gap-3'>
                            <div class='w-full flex justify-between'>
                                <p><span class='inline-block w-3 h-3 rounded-sm bg-[#1B84FF] mr-2'></span>Meubelair<span class='italic text-slate-400'> (Kursi, Meja, Lemari, etc.)</span></p>
                                <p id='percentage_meubelair' class='font-bold'>0%</p>
                            </div>
                            <div class='w-full flex justify-between'>
                                <p><span class='inline-block w-3 h-3 rounded-sm bg-[#17C653] mr-2'></span>Electronics<span class='italic text-slate-400'> (TV, Printter, Shredder etc.)</span></p>
                                <p id='percentage_electronic' class='font-bold'>0%</p>
                            </div>
                            <div class='w-full flex justify-between'>
                                <p><span class='inline-block w-3 h-3 rounded-sm bg-[#E4E6EF] mr-2'></span>Others<span class='italic text-slate-400'> (Troli, Tempat Sampah, etc.)</span></p>
                                <p id='percentage_other' class='font-bold'>0%</p>
                            </div>
                        </div>
                        <div id='asset_chart' class='min-h-[173px] min-w-[173px]'></div>
                    </div>
                </div>
                <div class='w-full h-full flex p-6 justify-between col-span-3 rounded-lg bg-[#1C325E] drop-shadow-md'>
                    <div class='h-full flex flex-col justify-between'>
                        <div>
                            <p class='text-2xl text-white font-semibold'>Well-Managed Assets</p>
                            <p class='text-xl text-white font-normal'>Are Investment in Future</p>
                        </div>
                        <div>
                            <p class='text-[#DCB168] font-medium'>With effective asset management, General Affairs supports the stability and growth of the company</p>
                        </div>                        
                    </div>
                    <img src="{{asset('assets/colored_pencils.svg')}}" alt="Colored Pencils" class="h-full w-auto">
                </div>
                <div class='w-full h-full flex flex-col justify-between p-6 col-span-2 rounded-lg bg-white drop-shadow-md'>
                    <div>
                        <p class='text-2xl font-semibold'>Meubelair</p>
                        <p class='text-base text-slate-400 font-normal'>Tangible Assets</p>
                    </div>
                    <div class='flex w-full justify-between items-end'>
                        <div>
                            <p class='text-sm text-slate-400 font-normal'>Total Assets</p>
                            <p id='total_meubelair' class='text-6xl text-black font-bold'>0</p>
                        </div>
                        <a href={{url('dashboard/meubelair')}}>
                            <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                                See All Assets
                            </button>
                        </a>
                    </div>
                </div>
                <div class='w-full h-full flex flex-col justify-between p-6 col-span-2 rounded-lg bg-white drop-shadow-md'>
                    <div>
                        <p class='text-2xl font-semibold'>Electronic</p>
                        <p class='text-base text-slate-400 font-normal'>Electronic Assets</p>
                    </div>
                    <div class='flex w-full justify-between items-end'>
                        <div>
                            <p class='text-sm text-slate-400 font-normal'>Total Assets</p>
                            <p id='total_electronic' class='text-6xl text-black font-bold'>0</p>
                        </div>
                        <a href={{url('dashboard/electronic')}}>
                            <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                                See All Assets
                            </button>
                        </a>
                    </div>
                </div>
                <div class='w-full h-full flex flex-col justify-between p-6 col-span-2 rounded-lg bg-white drop-shadow-md'>
                    <div>
                        <p class='text-2xl font-semibold'>Others</p>
                        <p class='text-base text-slate-400 font-normal'>Other Category Assets</p>
                    </div>
                    <div class='flex w-full justify-between items-end'>
                        <div>
                            <p class='text-sm text-slate-400 font-normal'>Total Assets</p>
                            <p id='total_other' class='text-6xl text-black font-bold'>0</p>
                        </div>
                        <a href={{url('dashboard/others')}}>
                            <button type="button" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-green-aida text-white hover:bg-green-600 disabled:opacity-50 disabled:pointer-events-none">
                                See All Assets
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>        
        @include('sweetalert::alert')
    </body>
    <script type="text/javascript">
        var category_raw = {!!$category_count!!}
        var category_count = {}
        var total_barang = 0

        category_raw.map((e)=>{
            category_count[e.jenis_barang] = e.jumlah_barang
            total_barang = total_barang + e.jumlah_barang
            document.getElementById(`total_${e.jenis_barang}`).innerText = e.jumlah_barang
        })

        document.getElementById('percentage_meubelair').innerText = (category_count.meubelair==null? 0:category_count.meubelair/total_barang)*100+'%'
        document.getElementById('percentage_electronic').innerText = (category_count.electronic==null? 0:category_count.electronic/total_barang)*100+'%'
        document.getElementById('percentage_other').innerText = (category_count.other==null? 0:category_count.other/total_barang)*100+'%'

        echarts.registerTheme('custom', {
            textStyle: {
                fontFamily: 'Poppins, Arial, sans-serif'
            }
        });

        var asset_chart = echarts.init(document.getElementById('asset_chart'), 'custom')
        console.log(asset_chart)

        var option = {
            tooltip: {
                trigger: 'item'
            },
            series: [
                {
                    type: 'pie',
                    radius: ['40%', '70%'],
                    avoidLabelOverlap: false,
                    label: {
                        show: false,
                        position: 'center'
                    },
                    labelLine: {
                        show: false
                    },
                    data: [
                        { value: category_count.meubelair==null? 0:category_count.meubelair, name: 'Meubelair', itemStyle: {color: '#1B84FF'} },
                        { value: category_count.electronic==null? 0:category_count.electronic, name: 'Electronics', itemStyle: {color: '#17C653'} },
                        { value: category_count.other==null? 0:category_count.other, name: 'Others', itemStyle: {color: '#E4E6EF'} }
                    ]
                }
            ]
        };

        asset_chart.setOption(option)
    </script>
</x-head>