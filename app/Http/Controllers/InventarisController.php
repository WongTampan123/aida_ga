<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\BulkUploadImport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class InventarisController extends Controller
{
    public function saveNewAsset(Request $request)
    {
        $request_validation = $request->validate([
            'jenis_barang' => 'required',
            'tipe_barang' => 'required',
            'lantai_barang' => 'required',
            'ruangan_barang' => 'required',
            'unit_barang' => 'required',
            'tahun_barang' => 'required'
        ]);

        // Kode Barang Generator
        $jenis = strtolower($request->input('jenis_barang'))=='electronic'? 'E':(strtolower($request->input('jenis_barang'))=='meubelair'? 'M':'O');
        $unit = DB::connection('mysql')->select('select aida.nama_unit.abbr_unit from aida.nama_unit where aida.nama_unit.nama_unit = ?',[$request->input('unit_barang')])[0]->abbr_unit;
        $tahun = substr($request->input('tahun_barang'), -2);
        $count_db = DB::connection('mysql')->select('select count(aida.inventaris.id_barang) as total_barang from aida.inventaris 
                    where aida.inventaris.id_barang like "%'.$jenis.''.$request->input('lantai_barang').''.$unit.''.$tahun.'"');
        $count = $count_db[0]->total_barang+1;
        $kode_barang = $count.$jenis.$request->input('lantai_barang').$unit.$tahun;
        
        // Save Image
        if($request->file('gambar_barang')){
            $image=$request->file('gambar_barang');
            $image_name = $kode_barang.'.'.$image->extension();
            $path=$image->move(public_path().'/assets/gambar_barang/',$image_name);
        } else {
            $image_name = 'photo_library.png';
        }

        $user = $request->session()->get('user');
        $unit_user = $request->session()->get('user')->id_unit_sppd;
        $area_barang = $unit_user=='Area Sumatera'? '01':($unit_user=='Area Jabodetabeb&Jabar'? '02':($unit_user=='Area Jawa Bali&Nusa Tenggara'? '03':($unit_user=='Area Pamasuka'? '04':'HQ')));

        DB::connection('mysql')->insert('insert into aida.inventaris(id_barang, jenis_barang, tipe_barang, quantity_barang, merk_barang, lantai_barang, ruangan_barang, tahun_barang, unit_barang, area_barang, seri_barang, is_approved, gambar_barang) 
            value(?,?,?,?,?,?,?,?,?,?,?,?,?)',[
            $kode_barang,
            $request->input('jenis_barang'),
            $request->input('tipe_barang'),
            $request->input('quantity_barang'),
            $request->input('merk_barang'),
            $request->input('lantai_barang'),
            $request->input('ruangan_barang'),
            $request->input('tahun_barang'),
            $request->input('unit_barang'),
            $area_barang,
            $request->input('seri_barang'),
            $unit_user=='Corporate Office'?'true':'ny',
            $image_name
        ]);
        
        $this->addHistory($kode_barang,'create','Asset Ditambahkan Oleh <b>'.$user->name.'('.$user->nik_tg.')</b>', date('Y-m-d H:i:s'));
        return response()->json(['message'=>'input berhasil']);
    }

    public function downloadTemplateBulkUpload()
    {
        return Storage::download('/public/template_upload.xlsx');
    }

    public function saveBulkUpload(Request $request)
    {
        $request->validate([
            'file_excel' => 'required'
        ]);

        $row = Excel::import(new BulkUploadImport, $request->file('file_excel'));
        
        return response()->json(['rows' => $row]);
    }

    public function saveImageBulkUpload(Request $request)
    {
        $request->validate([
            'file_gambar' => 'required'
        ]);

        $uploaded_files = $request->file('file_gambar');
        for($i=0; $i<count($uploaded_files); $i++){
            $path = $uploaded_files[$i]->move(public_path().'/assets/gambar_barang/',$uploaded_files[$i]->getClientOriginalName());

            DB::connection('mysql')->update('update aida.inventaris
                                            set gambar_barang = ? where id_barang = ?',[$uploaded_files[$i]->getClientOriginalName(), pathinfo($uploaded_files[$i]->getClientOriginalName(), PATHINFO_FILENAME)]);
        }

        return response()->json(['message' => 'Upload Berhasil']);
    }
    
    public function deleteAsset(Request $request)
    {
        DB::connection('mysql')->update('update aida.inventaris 
                                        set aida.inventaris.is_deleted="true"
                                        where aida.inventaris.id=?',[$request->input('id_barang')]);

        return response()->json(['message' => 'delete berhasil']);
    }

    public function updateAsset(Request $request)
    {
        $request_validation = $request->validate([
            'jenis_barang' => 'required',
            'tipe_barang' => 'required',
            'lantai_barang' => 'required',
            'ruangan_barang' => 'required',
            'unit_barang' => 'required',
            'tahun_barang' => 'required'
        ]);

        $user = $request->session()->get('user');
        $pre_update = DB::connection('mysql')
                    ->select('select aida.inventaris.* from aida.inventaris where aida.inventaris.id=?',[$request->id]);

        // $jenis = strtolower($request->input('jenis_barang'))=='electronic'? 'E':(strtolower($request->input('jenis_barang'))=='meubelair'? 'M':'O');
        // $unit = strtoupper($request->input('unit_barang'));
        // $tahun = substr($request->input('tahun_barang'), -2);
        // $count_db = DB::connection('mysql')->select('select count(aida.inventaris.id_barang) as total_barang from aida.inventaris 
        //             where aida.inventaris.id_barang like "%'.$jenis.''.$request->input('lantai_barang').''.$unit.''.$tahun.'"');
        // $count = $count_db[0]->total_barang+1;
        // $kode_barang = $count.$jenis.$request->input('lantai_barang').$unit.$tahun;

        if($request->file('gambar_barang')){
            $image=$request->file('gambar_barang');
            $image_name=$pre_update[0]->id_barang.'.'.$image->extension();
            $path=$image->move(public_path().'/assets/gambar_barang/',$image_name);
        } else {
            $image_name = DB::connection('mysql')->select('select aida.inventaris.gambar_barang from aida.inventaris where id=?',[$request->input('id')]);
            $image_name = $image_name[0]->gambar_barang;
        }

        DB::connection('mysql')->update('update aida.inventaris
                                        set jenis_barang=?, tipe_barang=?, quantity_barang=?, merk_barang=?, lantai_barang=?, ruangan_barang=?, tahun_barang=?, unit_barang=?, seri_barang=?, gambar_barang=?
                                        where aida.inventaris.id=?',[
            $request->input('jenis_barang'),
            $request->input('tipe_barang'),
            $request->input('quantity_barang'),
            $request->input('merk_barang'),
            $request->input('lantai_barang'),
            $request->input('ruangan_barang'),
            $request->input('tahun_barang'),
            $request->input('unit_barang'),
            $request->input('seri_barang'),
            $image_name,
            $request->input('id')
        ]);
        $this->addHistory($request->input('id_barang'),'edit','Asset Di-Edit Oleh <b>'.$user->name.'('.$user->nik_tg.')</b>', date('Y-m-d H:i:s'));

        return response()->json(['message'=>'input berhasil']);

    }

    public function approvalAsset(Request $request)
    {   
        $user = $request->session()->get('user');
        $approval = $request->input('approval')=='true'? 'approve':'reject';
        DB::connection('mysql')->update('update aida.inventaris 
                                        set is_approved = ? where aida.inventaris.id = ?', [$request->input('approval'), $request->input('id')]);

        $this->addHistory($request->input('id_barang'),$approval,'Asset Di-'.ucfirst($approval).' Oleh <b>'.$user->name.'('.$user->nik_tg.')</b>', date('Y-m-d H:i:s'));

        return;
    }

    public function searchAsset(Request $request)
    {   
        // $search_response = DB::connection('mysql')->select('select aida.inventaris.* from aida.inventaris
        //                                                     where aida.inventaris.is_deleted="false"
        //                                                     and aida.inventaris.jenis_barang like "%'.$request->input('jenis_barang').'%" 
        //                                                     and aida.inventaris.tahun_barang like "%'.$request->input('tahun_barang').'%"
        //                                                     and aida.inventaris.unit_barang like "%'.$request->input('unit_barang').'%"
        //                                                     and aida.inventaris.tipe_barang like "%'.$request->input('barang').'%"');
        $path = $request->input('path')? $request->input('path'):'asset';
        $sort = $request->input('sort')? $request->input('sort'):'asc';
        $stock_take_id = $request->input('stock_take_id')? $request->input('stock_take_id'):'';
        $user_unit = $request->session()->get('user')->id_unit_sppd;
        // $user_area = $unit_user=='Area Sumatera'? '01':($unit_user=='Area Jabodetabeb&Jabar'? '02':($unit_user=='Area Jawa Bali&Nusa Tenggara'? '03':($unit_user=='Area Pamasuka'? '04':'HQ')));
        $user_area = explode(' ', $user_unit)[0]=='Area'? $user_unit:'HQ';
        $user_regional = $request->session()->get('user')->psa_text;
        
        if($path=='add_stock_take'){
            $search_response = DB::connection('mysql')
                        ->table('aida.inventaris')
                        ->where('aida.inventaris.is_deleted','false')
                        ->where('aida.inventaris.is_approved','true')
                        ->where('aida.inventaris.is_functioning','true')
                        ->where('aida.inventaris.area_barang',$user_area)
                        ->where('aida.inventaris.jenis_barang', 'like', "%".$request->input('jenis_barang')."%")
                        ->where('aida.inventaris.tahun_barang', 'like', "%".$request->input('tahun_barang')."%")
                        ->where('aida.inventaris.unit_barang', 'like', "%".$request->input('unit_barang')."%")
                        ->where('aida.inventaris.is_approved', 'like', "%".$request->input('status_approval')."%")
                        ->where('aida.inventaris.tipe_barang', 'like', "%".$request->input('barang')."%")                        
                        ->orderBy('aida.inventaris.tipe_barang',$sort=='asc'? "ASC":"DESC")
                        ->paginate(10);
        } elseif ($path=='stock_take_detail') {
            $search_response = DB::connection('mysql')
                        ->table('aida.inventaris')
                        ->where('aida.inventaris.is_deleted','false')
                        ->where('aida.inventaris.is_approved','true')
                        ->where('aida.inventaris.stock_take_id',$stock_take_id)
                        ->where('aida.inventaris.jenis_barang', 'like', "%".$request->input('jenis_barang')."%")
                        ->where('aida.inventaris.tahun_barang', 'like', "%".$request->input('tahun_barang')."%")
                        ->where('aida.inventaris.unit_barang', 'like', "%".$request->input('unit_barang')."%")
                        ->where('aida.inventaris.tipe_barang', 'like', "%".$request->input('barang')."%")
                        ->orderBy('aida.inventaris.tipe_barang',$sort=='asc'? "ASC":"DESC")
                        ->paginate(10);
        } else {
            $search_response = DB::connection('mysql')
                        ->table('aida.inventaris')
                        ->where('aida.inventaris.is_deleted','false')
                        ->where('aida.inventaris.unit_barang', 'like', "%".$user_unit."%")
                        ->where('aida.inventaris.regional_barang', 'like', "%".(explode(' ', $user_unit)[0]=='Area'?$user_regional:'hq')."%")
                        ->where('aida.inventaris.jenis_barang', 'like', "%".$request->input('jenis_barang')."%")
                        ->where('aida.inventaris.tahun_barang', 'like', "%".$request->input('tahun_barang')."%")
                        ->where('aida.inventaris.unit_barang', 'like', "%".$request->input('unit_barang')."%")
                        ->where('aida.inventaris.is_approved', 'like', "%".$request->input('status_approval')."%")
                        ->where('aida.inventaris.tipe_barang', 'like', "%".$request->input('barang')."%")
                        ->where('aida.inventaris.ruangan_barang', 'like', "%".$request->input('ruangan')."%")
                        ->where('aida.inventaris.is_functioning', 'like', "%".$request->input('kondisi_barang')."%")
                        ->orderBy('aida.inventaris.tipe_barang',$request->input('sort')=='asc'? "ASC":"DESC")
                        ->paginate(10);
        }

            return response()->json([
                'view' => View::make('asset_list_table', ['asset_list' => $search_response, 'path' => $path, 'sort' => $sort])->render()
            ]);
        
    }

    public function searchStockTake(Request $request)
    {
       $search_response = DB::connection('mysql')
                        ->table('aida.stock_take')
                        ->where('aida.stock_take.stock_take_id', 'like', "%".$request->input('stock_take_id')."%")
                        ->paginate(10);
        
        
            return response()->json([
                'view' => View::make('stock_take_table', ['stock_take_list' => $search_response])->render(),
                'stock_take_list' => $search_response
            ]);
        
    }

    public function newStockTake(Request $request)
    {
        $selected_asset = $request->session()->get('selected_asset');
        
        $unit_user = $request->session()->get('user')->id_unit_sppd;
        $area_user = $unit_user=='Area Sumatera'? '01':($unit_user=='Area Jabodetabeb&Jabar'? '02':($unit_user=='Area Jawa Bali&Nusa Tenggara'? '03':($unit_user=='Area Pamasuka'? '04':'HQ')));
        $date = date('Y-m-d');
        $unit = DB::connection('mysql')
            ->table('aida.nama_unit')
            ->where('aida.nama_unit.nama_unit',$unit_user)
            ->first()
            ->abbr_unit;        
        $count = DB::connection('mysql')
            ->table('aida.stock_take')
            ->select([DB::raw('count(aida.stock_take.stock_take_id) as count_stock_take')])
            ->where('aida.stock_take.stock_take_id','like','%'.$unit.'%')
            ->first()
            ->count_stock_take;
        $new_stock_take = $date.'-'.$unit.'-'.str_pad($count+1,4,0,STR_PAD_LEFT);

        DB::connection('mysql')
        ->table('aida.stock_take')
        ->insert([
            'stock_take_id' => $new_stock_take,
            'jumlah_barang' => count($selected_asset),
            'unit' => $unit_user,
            'area' => $area_user,
            'created_by' => $request->session()->get('user')->name
        ]);

        foreach ($selected_asset as $asset_id) {
            DB::connection('mysql')
            ->table('aida.inventaris')
            ->where('aida.inventaris.id', $asset_id)
            ->update([
                'stock_take_id' => $new_stock_take,
                'is_functioning' => 'false'
            ]);
        }

        return response()->json(['stock_take_id'=>$new_stock_take]);
    }

    public function exportStockTake(Request $request)
    {
        $user = $request->session()->get('user');
        $stock_take_id = $request->input('stock_take_id');
        $stock_take_items = DB::connection('mysql')
                            ->table('aida.inventaris')
                            ->where('aida.inventaris.stock_take_id','=',$stock_take_id)
                            ->get();
        $items_category = [];

        foreach ($stock_take_items as $item) {
            if(!isset($items_category[$item->jenis_barang])){
                $items_category[$item->jenis_barang] = [$item];
            } else {
                array_push($items_category[$item->jenis_barang],$item);
            }
        }
        
        $data = [
            'title' => 'Stock Take -'.$stock_take_id,
            'stock_take_id' => $stock_take_id,
            'user' => $user,
            'mgr_general_affair' => $request->input('mgr_general_affair'),
            'vp_corporate_office' => $request->input('vp_corporate_office'),
            'svp_corporate_secreatry' => $request->input('svp_corporate_secretary'),
            'items_category' => $items_category
        ];

        return $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 
                'isRemoteEnabled' => true])
                ->loadView('export_stock_take', $data)->download('StockTake-'.$stock_take_id.'.pdf');
    }

    public function clickCheckbox(Request $request)
    {
        $selected_asset = $request->session()->has('selected_asset')? $request->session()->get('selected_asset'):[]; //Check apakah ada session bernama selected_asset, kalau tidak ada inisasi dengan array kosong

        $id_asset = array_search($request->input('id'),$selected_asset); //Cek apakah id barang ada di array tsb. (return dari fungsi ini adalah index)
        if($id_asset!==false){
            array_splice($selected_asset,$id_asset,1); //Kalau ada, hapus Id tsb
        } else {
            array_push($selected_asset,$request->input('id')); //Kalau tidak ada, tambahkan Id tsb
        }

        $request->session()->put('selected_asset',$selected_asset); //Simpan ke session

        return response()->json([
            'checkbox' => $request->session()->get('selected_asset')
        ]);
    }

    public function exportExcel(Request $request)
    {   
        if($request->session()->has('selected_asset') && !empty($request->session()->get('selected_asset'))){
            $data = [];
            foreach($request->session()->get('selected_asset') as $id){
                $buffer_data = DB::connection('mysql')
                        ->select('select aida.inventaris.* from aida.inventaris
                        where aida.inventaris.id=? and aida.inventaris.is_deleted=?',[$id,'false']);
                array_push($data, $buffer_data[0]);
            }
        } else {
            $data = DB::connection('mysql')
                ->select('select aida.inventaris.* from aida.inventaris
                where aida.inventaris.is_deleted=?',['false']);
        }        

        return view('export_excel',['all_data' => $data]);
    }

    public function addHistory($id_barang,$action,$message,$date)
    {
        $user = request()->session()->get('user');

        DB::connection('mysql')
        ->table('aida.action_history')
        ->insert([
            'id_barang' => $id_barang,
            'user_nik' => $user->nik_tg,
            'action' => $action,
            'message' => $message,
            'created_at' => $date
        ]);

        return;
    }
}
