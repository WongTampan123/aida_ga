<!DOCTYPE html>
<html>
<head>
    <title>Stock Take - {{$stock_take_id}}</title>
    <style>
        @page {
            margin-top: 0.5in;
            margin-bottom: 0.5in;
            margin-left: 1in;
            margin-right: 1in;
        }
        body {
            margin: 0;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        th{
            font-size: 12px;
        }
        .paragraph{
            text-indent: 2.5rem;
            text-align: justify;
            font-size: 1rem;
            line-height: 1.5rem;
            margin:0;
        }
        .page-break {
            page-break-after: always; /* Halaman baru setelah elemen ini */
        }
    </style>
</head>
<body>
    <img src="{{asset('assets/logo_mitratel.png')}}" alt="Logo Mitratel" style="width:30%; height:auto">
    <p style="margin-bottom: 5px;"><b>Nomor: {{$stock_take_id}}</b></p>
    <p style="margin-bottom: 5px;"><b>Tanggal: {{date('Y/m/d')}}</b></p>
    <p class='paragraph' style="margin-top: 2rem;">Berdasarkan kebutuhan perusahaan untuk melakukan verifikasi terhadap jumlah
        persediaan barang yang tercatat, kami telah melakukan kegiatan Stock Take dan
        memohon persetujuan untuk pelaksanaan kegiatan tersebut.</p>
    <p class='paragraph'>
            Adapun daftar barang yang sudah dihitung dan disiapkan oleh tim yang telah
        ditunjuk. Hasil dari stock take ini akan dilaporkan kepada manajemen untuk penyesuaian
        data persediaan.
    </p>
    <p><b>Daftar Barang:</b></p>
    @for($i=0; $i < count($items_category); $i++)
        <p><b>{{$i+1}}. Kategori {{ucfirst(array_keys($items_category)[$i])}}</b></p>
        <table>
            <tr>
                <th style="width:10%">No.</th>
                <th>Kode</th>
                <th>Jenis Barang</th>  
                <th>Nama Barang</th>
                <th>Kondisi</th>
                <th>Unit</th>                
                <th>Area</th>
                <th>Budget</th>
            </tr>
            @for($s=0; $s< count($items_category[array_keys($items_category)[$i]]); $s++)
            <tr>
                <th style="width:10%; font-size: 10px; font-weight: 400;">{{$s+1}}</th>
                <th style="font-size: 10px; font-weight: 400;">{{$items_category[array_keys($items_category)[$i]][$s]->id_barang}}</th>
                <th style="font-size: 10px; font-weight: 400;">{{ucfirst($items_category[array_keys($items_category)[$i]][$s]->tipe_barang)}}</th>
                <th style="font-size: 10px; font-weight: 400;">{{ucfirst($items_category[array_keys($items_category)[$i]][$s]->seri_barang)}}</th>
                <th style="font-size: 10px; font-weight: 400;">Rusak</th>
                <th style="font-size: 10px; font-weight: 400;">{{$items_category[array_keys($items_category)[$i]][$s]->unit_barang}}</th>
                <th style="font-size: 10px; font-weight: 400;">{{$items_category[array_keys($items_category)[$i]][$s]->area_barang}}</th>
                <th style="font-size: 10px; font-weight: 400;">{{$items_category[array_keys($items_category)[$i]][$s]->sumber_anggaran_barang}}</th>
            </tr>
            @endfor
        </table>
    @endfor
    <div class='page-break'></div>
    <p style="font-size:1.5rem"><b>Halaman Persetujuan</b></p>
    <table style='margin-bottom: 1.5rem' cellpadding="10" cellspacing="0">
        <tr>
            <td colspan="3">{{$user->short_posisi}}</td>
        </tr>
        <tr>
            <td style="width:10%">Nama</td>
            <td>{{$user->name}}</td>
            <td rowspan='2'></td>
        </tr>
        <tr>
            <td style="width:10%">Tanggal</td>
            <td>{{date("Y/m/d")}}</td>
        </tr>
    </table>
    <table style='margin-bottom: 1.5rem' cellpadding="10" cellspacing="0">
        <tr>
            <td colspan="3">MANAGER GENERAL AFFAIR</td>
        </tr>
        <tr>
            <td style="width:10%">Nama</td>
            <td>{{$mgr_general_affair}}</td>
            <td rowspan='2'></td>
        </tr>
        <tr>
            <td style="width:10%">Tanggal</td>
            <td>{{date("Y/m/d")}}</td>
        </tr>
    </table>
    <table style='margin-bottom: 1.5rem' cellpadding="10" cellspacing="0">
        <tr>
            <td colspan="3">VP CORPORATE OFFICE</td>
        </tr>
        <tr>
            <td style="width:10%">Nama</td>
            <td>{{$vp_corporate_office}}</td>
            <td rowspan='2'></td>
        </tr>
        <tr>
            <td style="width:10%">Tanggal</td>
            <td>{{date("Y/m/d")}}</td>
        </tr>
    </table>
    <table style='margin-bottom: 1.5rem' cellpadding="10" cellspacing="0">
        <tr>
            <td colspan="3">SVP CORPORATE SECRETARY</td>
        </tr>
        <tr>
            <td style="width:10%">Nama</td>
            <td>{{$svp_corporate_secreatry}}</td>
            <td rowspan='2'></td>
        </tr>
        <tr>
            <td style="width:10%">Tanggal</td>
            <td>{{date("Y/m/d")}}</td>
        </tr>
    </table>
    <div class='page-break'></div>
    <p style="font-size:1.5rem"><b>Halaman Lampiran</b></p>
    @php
        $faltten_items = collect($items_category)->flatten();
        $chunk_items = $faltten_items->chunk(3);
    @endphp
    <table style="border: 0px">
        @for($i=0; $i< count($chunk_items); $i++)
            <tr style="border: 0px">
                @foreach($chunk_items[$i] as $item)
                    <td style="border: 0px; text-align: center;">                    
                        <img src="{{asset('/assets/gambar_barang/'.$item->gambar_barang)}}" alt="Description" width="150" height="150" style="margin-bottom: 1rem">
                        <p>{{$item->id_barang}}</p>
                    </td>
                @endforeach
            </tr>
        @endfor    
    </table>
</body>
</html>