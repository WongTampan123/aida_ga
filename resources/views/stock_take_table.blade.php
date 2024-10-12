                    <div class='flex grow w-full overflow-x-auto'>
                        <table class="max-md:w-[300%] max-xl:w-[200%] w-full h-full divide-y divide-gray-200">
                            <thead class="sticky top-0 bg-white z-10">
                                <tr>
                                    <!-- <th class="py-1 items-center text-center">
                                        <input type="checkbox" class="inline-flex items-center shrink-0 mt-0.5 border-gray-200 rounded text-green-600 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none bg-[#F6F6F6]">
                                    </th> -->
                                    <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">NAMA DOKUMEN</th>
                                    <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">QTY BARANG</th>
                                    <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">TANGGAL PEMBUATAN</th>
                                    <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">AREA</th>
                                    <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">UNIT</th>
                                    <th scope="col" class="text-center text-xs font-semibold text-gray-500 uppercase">PEMBUAT</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class='divide-y divide-gray-200'>
                                @foreach($stock_take_list as $stock_take)
                                    <tr class="h-16 hover:bg-green-200">
                                        {{-- Checkbox --}}
                                        <td class="relative flex items-center justify-center h-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-description mr-2 mb-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="1" stroke="#6b7280" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                <path d="M9 17h6" />
                                                <path d="M9 13h6" />
                                            </svg>
                                            <div>
                                                <p class="text-sm text-gray-500 font-medium truncate">{{ucwords($stock_take->stock_take_id)}}</p>
                                            </div>
                                        </td>
                                        <td class="text-xs text-gray-500 text-center">{{$stock_take->jumlah_barang}}</td>
                                        <td class="text-xs text-gray-500 text-center">{{$stock_take->created_at}}</td>
                                        <td class="text-xs text-gray-500 text-center">{{$stock_take->area}}</td>
                                        <td class="text-xs text-gray-500 text-center">{{$stock_take->unit}}</td>
                                        <td class="text-xs text-gray-500 text-center">{{$stock_take->created_by}}</td>
                                        <td>
                                            <div class="dropdown dropdown-end">
                                                <div tabindex="0" role="button" class="py-1 px-2 inline-flex items-center gap-x-2 text-xs font-medium rounded-lg bg-[#F6F6F6] text-black hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none">
                                                    Actions
                                                    <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                                                </div>
                                                <div tabindex="0" class="menu dropdown-content bg-base-100 rounded-lg z-[1] min-w-32 shadow-md rounded-lg p-2 mt-2 shadow-[0_2px_5px_1px_rgba(0,0,0,0.15)]">
                                                    <a href="{{url('/stock_take/'.$stock_take->stock_take_id)}}" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100">
                                                        Details
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $stock_take_list->onEachSide(1)->links() }}
                    </div>