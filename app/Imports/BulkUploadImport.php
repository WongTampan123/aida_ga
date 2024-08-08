<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class BulkUploadImport implements WithMultipleSheets
{
    /**
    * @param Collection $collection
    */   

    public function sheets(): array
    {
        return [
            0 => new FirstSheetImport()
        ];
    }    
}

class FirstSheetImport implements ToCollection, WithHeadingRow
    {
        protected $sessionData;

        public function __construct(){
            $this->sessionData = Session::get('user');
        }

        public function collection(Collection $rows)
        {
            $user = $this->sessionData;
    
            if($user->id_unit_sppd=='Area Sumatera'){
                $area = '01';
            } elseif ($user->id_unit_sppd=='Area Jabodetabeb&Jabar') {
                $area = '02';
            } elseif ($user->id_unit_sppd=='Area Jawa Bali&Nusa Tenggara'){
                $area = '03';
            } elseif ($user->id_unit_sppd=='Area Pamasuka'){
                $area = '04';
            } else {
                $area = 'HQ';
            }
    
            // var_dump($rows);
    
            foreach ($rows as $row) {
                $id_barang = $this->id_barang($row['jenis_barang'],$row['lantai_barang'],$row['unit_barang'],$row['tahun_barang']);
    
                DB::connection('mysql')
                ->table('aida.inventaris')
                ->insert([
                    'id_barang' => $id_barang,
                    'jenis_barang' => strtolower($row['jenis_barang']),
                    'tipe_barang' => strtolower($row['tipe_barang']),
                    'seri_barang' => $row['seri_barang'],
                    'quantity_barang' => $row['quantity_barang'],
                    'merk_barang' => $row['merk_barang'],
                    'lantai_barang' => $row['lantai_barang'],
                    'area_barang' => $area,
                    'ruangan_barang' => $row['ruangan_barang'],
                    'tahun_barang' => $row['tahun_barang'],
                    'unit_barang' => $row['unit_barang'],
                    'is_approved' => $user->id_unit_sppd=='Corporate Office'? 'true':'ny', 
                    'gambar_barang' => 'photo_library.svg'
                ]);            
            }
        }

        public function id_barang($jenis_barang, $lantai_barang, $unit_barang, $tahun_barang){
            $jenis = strtolower($jenis_barang)=='electronic'? 'E':(strtolower($jenis_barang)=='meubelair'? 'M':'O');
            $unit = DB::connection('mysql')->select('select aida.nama_unit.abbr_unit from aida.nama_unit where aida.nama_unit.nama_unit = ?',[$unit_barang])[0]->abbr_unit;
            $tahun = substr($tahun_barang, -2);
    
            $count_db = DB::connection('mysql')->select('select count(aida.inventaris.id_barang) as total_barang from aida.inventaris 
                        where aida.inventaris.id_barang like "%'.$jenis.''.$lantai_barang.''.$unit.''.$tahun.'"');
    
            $count = $count_db[0]->total_barang+1;
    
            return $count.$jenis.$lantai_barang.$unit.$tahun;        
        }
    }
