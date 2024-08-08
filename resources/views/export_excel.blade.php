@php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Export AIDA.xls");
@endphp

<table>
    <thead>
        <tr>
            <th>Kode Barang</th>
            <th>Tipe Barang</th>
            <th>Jenis Barang</th>
            <th>Merk Barang</th>
            <th>Seri Barang</th>
            <th>Tahun Pengadaan</th>
            <th>Kuantitas</th>
            <th>Ruangan</th>
            <th>Lantai</th>
            <th>Unit</th>
            <th>Area</th>
            <th>Status Approval</th>
        </tr>
    </thead>
    <tbody>
        @foreach($all_data as $data)
        <tr>            
            <td>{{$data->id_barang}}</td>
            <td>{{$data->tipe_barang}}</td>
            <td>{{$data->jenis_barang}}</td>
            <td>{{$data->merk_barang}}</td>            
            <td>{{$data->seri_barang}}</td>
            <td>{{$data->tahun_barang}}</td>
            <td>{{$data->quantity_barang}}</td>
            <td>{{$data->ruangan_barang}}</td>
            <td>{{$data->lantai_barang}}</td>
            <td>{{$data->unit_barang}}</td>
            <td>{{$data->area_barang}}</td>
            <td>{{$data->is_approved=='ny'? 'NY Approved':($data->is_approved=='true'?'Approved':'Rejected')}}</td>
        </tr>
        @endforeach
    </tbody>
</table>