<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class PageController extends Controller
{
    public function showPage()
    {
        if(session()->has('user')){
            return redirect('/dashboard');
        } else {
            if(session()->has('fail')){
                Alert::error('NIK/Password Salah', 'NIK atau Password yang Dimasukkan Salah, Silahkan Cek Kembali');
            }            
            return view('login_page', ["title" => "AIDA - Aplikasi Inventarisasi Data Asset"]);
        }
        // return view('login_page');
    }

    public function showDashboard()
    {
        $user_view = request()->session()->get('user')->privilage['view'];
        $category_count = DB::connection('mysql')
                        ->table('aida.inventaris')
                        ->select([
                            'aida.inventaris.jenis_barang',
                            DB::raw('count(aida.inventaris.id) as jumlah_barang')
                        ])
                        ->where('aida.inventaris.is_deleted','false')
                        ->where('aida.inventaris.is_functioning','true')
                        ->when(explode(" ",$user_view['unit'])[0]=='Area', function($query) use ($user_view) {
                            return $query->where('aida.inventaris.regional_barang',$user_view['regional']);
                        }, function($query) use ($user_view){
                            if(explode(" ",$user_view['unit'])[0]=='hq'){
                                return null;
                            } else {
                                return $query->where('aida.inventaris.unit_barang',$user_view['unit']);
                            }                            
                        })
                        ->groupBy('aida.inventaris.jenis_barang')
                        ->get();

        return view('dashboard', ["title" => "AIDA - Dashboard", "category_count" => json_encode($category_count)]);
    }

    public function showCategoryList($category)
    {
        $subcategory_count = DB::connection('mysql')
                            ->select('select aida.inventaris.tipe_barang, count(aida.inventaris.tipe_barang) as jumlah_barang
                            from aida.inventaris
                            where aida.inventaris.jenis_barang=? and
                            aida.inventaris.is_deleted="false"
                            group by aida.inventaris.tipe_barang',[$category]);
        
        $asset_list = DB::connection('mysql')
                    ->select('select aida.inventaris.* from aida.inventaris
                    where aida.inventaris.jenis_barang=?',[$category]);

        return view('asset_list', ["title" => "AIDA - ".ucfirst($category)." Category", "asset_list"=>$asset_list]);
    }

    public function showAssetList($category,$subcategory)
    {
        $asset_list = DB::connection('mysql')
                    ->select('select aida.inventaris.*
                    from aida.inventaris
                    where aida.inventaris.jenis_barang=? and aida.inventaris.tipe_barang=? and aida.inventaris.is_deleted="false"',[$category, $subcategory]);

        return view('asset_list', ["title" => "AIDA - ".ucfirst($subcategory)." List", "asset_list" => $asset_list]);
    }

    public function showAllAssetList(Request $request)
    {
        $jenis_barang = $request->input('jenis_barang')?$request->input('jenis_barang'):'';
        $request->session()->forget('selected_asset');

        // $asset_list = DB::connection('mysql')
        //             ->select('select aida.inventaris.*
        //             from aida.inventaris 
        //             where aida.inventaris.is_deleted="false" and aida.inventaris.jenis_barang like "%'.$jenis_barang.'%"')
        //             ->paginate(10)
        //             ->onEachSide(2);

        // $asset_list = DB::connection('mysql')
        //             ->table('aida.inventaris')
        //             ->where('aida.inventaris.is_deleted','false')
        //             ->paginate(2);


        $jenis_barang_list = DB::connection('mysql')
                            ->select('select distinct aida.inventaris.jenis_barang from aida.inventaris
                            where aida.inventaris.is_deleted="false"');
        $tahun_barang_list = DB::connection('mysql')
                            ->select('select distinct aida.inventaris.tahun_barang from aida.inventaris
                            where aida.inventaris.is_deleted="false" order by aida.inventaris.tahun_barang asc');
        $unit_barang_list = DB::connection('mysql')
                            ->select('select aida.nama_unit.nama_unit from aida.nama_unit');

        return view('all_asset_list', ["title" => "AIDA - All Asset List", "jenis_barang_list" => $jenis_barang_list, "tahun_barang_list" => $tahun_barang_list, "unit_barang_list" => $unit_barang_list]);
    }
    
    // public function showAddAssetForm($category,$subcategory)
    // {
    //     return view('add_asset_form', ['title' => 'AIDA - Add New Asset']);
    // }

    public function showAddAssetForm()
    {
        $unit_list = DB::connection('mysql')
                    ->select('select aida.nama_unit.* from aida.nama_unit');

        return view('add_asset_form', ['title' => 'AIDA - Add New Asset', 'unit_list' => $unit_list]);
    }

    public function showEditAssetForm($asset_id)
    {
        $asset_data = DB::connection('mysql')
                    ->select('select aida.inventaris.* 
                    from aida.inventaris
                    where id_barang=?',[$asset_id]);
        
        $unit_list = DB::connection('mysql')
                    ->select('select aida.nama_unit.* from aida.nama_unit');

        $history = DB::connection('mysql')
                    ->table('aida.action_history')
                    ->where('aida.action_history.id_barang',$asset_data[0]->id_barang)
                    ->orderBy('aida.action_history.created_at','asc')
                    ->get();

        return view('edit_asset_form', ['title' => 'AIDA - '.$asset_id, 'asset_data' => $asset_data[0], 'unit_list' => $unit_list, 'history' => $history]);
    }

    public function showStockTake()
    {
        return view('stock_take', ['title' => 'AIDA - Stock Take']);
    }

    public function showAddStockTake()
    {
        request()->session()->forget('selected_asset');
        $jenis_barang_list = DB::connection('mysql')
                            ->select('select distinct aida.inventaris.jenis_barang from aida.inventaris
                            where aida.inventaris.is_deleted="false"');
        $tahun_barang_list = DB::connection('mysql')
                            ->select('select distinct aida.inventaris.tahun_barang from aida.inventaris
                            where aida.inventaris.is_deleted="false" order by aida.inventaris.tahun_barang asc');
        $unit_barang_list = DB::connection('mysql')
                            ->select('select aida.nama_unit.nama_unit from aida.nama_unit');

        return view('add_stock_take', ['title' => 'AIDA - Add Stock Take', 'jenis_barang_list' => $jenis_barang_list, 'tahun_barang_list' => $tahun_barang_list, 'unit_barang_list' => $unit_barang_list]);
    }

    public function showStockTakeDetail($stock_take_id)
    {   
        $stock_take_items = DB::connection('mysql')
                            ->table('aida.inventaris')
                            ->where('aida.inventaris.stock_take_id',$stock_take_id)
                            ->paginate(10);
        
        $jenis_barang_list = DB::connection('mysql')
                            ->select('select distinct aida.inventaris.jenis_barang from aida.inventaris
                            where aida.inventaris.is_deleted="false"');
        $tahun_barang_list = DB::connection('mysql')
                            ->select('select distinct aida.inventaris.tahun_barang from aida.inventaris
                            where aida.inventaris.is_deleted="false" order by aida.inventaris.tahun_barang asc');
        $unit_barang_list = DB::connection('mysql')
                            ->select('select aida.nama_unit.nama_unit from aida.nama_unit');

        return view('stock_take_detail', ["title" => "AIDA - Stock Take (".$stock_take_id.")", "stock_take_id" => $stock_take_id, "stock_take_items" => $stock_take_items, "jenis_barang_list" => $jenis_barang_list, "tahun_barang_list" => $tahun_barang_list, "unit_barang_list" => $unit_barang_list]);
    }

    public function showBulkUpload()
    {
        return view('bulk_upload', ['title' => 'AIDA - Bulk Upload']);
    }

    public function getAssetTable(){
        $asset_list = DB::connection('mysql')
                    ->table('aida.inventaris')
                    ->where('aida.inventaris.is_deleted','false')
                    ->paginate(10);
        
        return response()->json([
            'view' => View::make('asset_list_table', ['asset_list' => $asset_list])->render()
        ]);
    }

    public function getStockTakeTable(){
        $stock_take_list = DB::connection('mysql')
                    ->table('aida.stock_take')
                    ->paginate(10);
        
        return response()->json([
            'view' => View::make('stock_take_table', ['stock_take_list' => $stock_take_list])->render()
        ]);
    }
}
