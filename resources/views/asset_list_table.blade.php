                    <div class='flex grow w-full overflow-x-auto'>
                        <table class="max-md:w-[300%] max-xl:w-[200%] w-full h-full divide-y divide-gray-200">
                            <thead class="sticky top-0 bg-white z-10">
                                <tr>
                                    <!-- <th class="py-1 items-center text-center">
                                        <input type="checkbox" class="inline-flex items-center shrink-0 mt-0.5 border-gray-200 rounded text-green-600 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none bg-[#F6F6F6]">
                                    </th> -->
                                    <th></th>
                                    <th scope="col" class="text-start text-xs font-semibold text-gray-500 uppercase">Jenis & Tipe Barang</th>
                                    <th></th>
                                    <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">KODE</th>
                                    <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">AREA</th>
                                    <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">QTY</th>
                                    <th scope="col" class="text-start text-xs font-semibold text-gray-500 uppercase">MERK</th>
                                    <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">LANTAI</th>
                                    <th scope="col" class="text-start text-xs font-semibold text-gray-500 uppercase">RUANGAN</th>
                                    <th scope="col" class="text-start text-xs font-semibold text-gray-500 uppercase">TAHUN</th>
                                    <th scope="col" class="text-start text-xs font-semibold text-gray-500 uppercase">UNIT</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class='divide-y divide-gray-200'>
                                @foreach($asset_list as $asset)
                                    <tr class="h-16 hover:bg-green-200">
                                        {{-- Checkbox --}}
                                        <td class="text-center">
                                            @if(in_array($asset->id, Session::get('selected_asset')?Session::get('selected_asset'):[]))
                                                <input type="checkbox" onclick="clickCheckbox({{$asset->id}})" checked class="inline-flex items-center shrink-0 border-gray-200 rounded text-green-600 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none bg-[#F6F6F6]">
                                            @else
                                                <input type="checkbox" onclick="clickCheckbox({{$asset->id}})" class="inline-flex items-center shrink-0 border-gray-200 rounded text-green-600 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none bg-[#F6F6F6]">
                                            @endif
                                        </td>
                                        <td class="relative flex items-center h-full">
                                            <div class="h-9 w-9 overflow-hidden mr-3">
                                                <img class="object-contain w-full h-full" src="{{asset('/assets/gambar_barang/'.$asset->gambar_barang)}}" alt="Asset Image">
                                            </div>
                                            <div>
                                                <p class="text-base font-medium truncate">{{ucwords($asset->tipe_barang)}}</p>
                                                <p class="text-xs text-gray-300 whitespace-nowrap">Tipe:{{$asset->seri_barang}}</p>
                                            </div>
                                        </td>
                                        <td class="text-center"><span class="text-xs font-semibold py-0.5 px-2 text-white rounded-md {{$asset->is_functioning=='true'? 'bg-green-aida':'bg-red-500'}}">{{$asset->is_functioning=='true'? 'Bagus':'Rusak'}}</span></td>
                                        <td class="text-center"><span class="text-xs font-semibold py-0.5 px-2 text-black rounded-md bg-[#F6F6F6]">{{$asset->id_barang}}</span></td>
                                        <td class="text-sm text-gray-500 text-center">{{$asset->area_barang}}</td>
                                        <td class="text-sm text-gray-500 text-center">{{$asset->quantity_barang}}</td>
                                        <td class="text-sm text-gray-500 text-start">{{$asset->merk_barang}}</td>
                                        <td class="text-sm text-gray-500 text-center">{{$asset->lantai_barang}}</td>
                                        <td class="text-sm text-gray-500 text-start">{{$asset->ruangan_barang}}</td>
                                        <td class="text-sm text-gray-500 text-start">{{$asset->tahun_barang}}</td>
                                        <td class="text-sm text-gray-500 text-start">{{$asset->unit_barang}}</td>
                                        <td class="text-center"><span class="text-xs font-semibold py-0.5 px-2 text-white rounded-md {{$asset->is_approved=='true'? 'bg-green-aida':($asset->is_approved=='false'? 'bg-red-500':'bg-yellow-500')}}">{{$asset->is_approved=='true'? 'Approved':($asset->is_approved=='false'? 'Rejected':'NY Approved')}}</span></td>
                                        <td>
                                            <div class="dropdown dropdown-end">
                                                <div tabindex="0" role="button" class="py-1 px-2 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg bg-[#F6F6F6] text-black hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                                    Actions
                                                    <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                                </div>
                                                <div tabindex="0" class="menu dropdown-content bg-base-100 rounded-lg z-10 min-w-32 shadow-md rounded-lg p-2 mt-2 shadow-[0_2px_5px_1px_rgba(0,0,0,0.15)]">
                                                    <a href="{{url('/assets/'.$asset->id_barang)}}" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                                        Edit
                                                    </a>
                                                    <a onclick='deleteAsset({{$asset->id}})' class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100" href="#">
                                                        Delete
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- <div class="hs-dropdown relative inline-flex">
                                                <button id="hs-dropdown-default" type="button" class="hs-dropdown-toggle py-1 px-2 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg bg-[#F6F6F6] text-black hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                                    Actions
                                                    <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                                </button>

                                                <div class="hs-dropdown-menu transition-[opacity,margin] z-10 duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-32 bg-white shadow-md rounded-lg p-2 mt-2 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" aria-labelledby="hs-dropdown-default">
                                                    <a href="{{url('/assets/'.$asset->id_barang)}}" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                                        Edit
                                                    </a>
                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100" href="#">
                                                        Delete
                                                    </a>
                                                </div>
                                            </div> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $asset_list->onEachSide(1)->links() }}
                    </div>