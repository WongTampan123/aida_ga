<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $category_count = DB::connection('mysql')
                        ->select('select aida.inventaris.jenis_barang,count(aida.inventaris.id) as jumlah_barang
                        from aida.inventaris
                        group by aida.inventaris.jenis_barang');

        return view('dashboard', ["title" => "AIDA - Dashboard", "category_count" => json_encode($category_count)]);
    }

    public function showDashboardCategory($category)
    {
        $subcategory_count = DB::connection('mysql')
                            ->select('select aida.inventaris.tipe_barang, count(aida.inventaris.tipe_barang) as jumlah_barang
                            from aida.inventaris
                            where aida.inventaris.jenis_barang=?
                            group by aida.inventaris.tipe_barang',[$category]);

        return view('dashboard_category', ["title" => "AIDA - ".ucfirst($category)." Category", "subcategory_count"=>$subcategory_count]);
    }

    public function showAssetList($category,$subcategory)
    {
        $asset_list = DB::connection('mysql')
                    ->select('select aida.inventaris.*
                    from aida.inventaris
                    where aida.inventaris.jenis_barang=? and aida.inventaris.tipe_barang=?',[$category, $subcategory]);

        return view('asset_list', ["title" => "AIDA - ".ucfirst($subcategory)." List", "asset_list" => $asset_list]);
    }

    public function showAllAssetList()
    {
        $asset_list = DB::connection('mysql')
                    ->select('select aida.inventaris.*
                    from aida.inventaris');

        return view('all_asset_list', ["title" => "AIDA - All Asset List", "asset_list" => $asset_list]);
    }
    
    // public function showAddAssetForm($category,$subcategory)
    // {
    //     return view('add_asset_form', ['title' => 'AIDA - Add New Asset']);
    // }

    public function showAddAssetForm()
    {
        return view('add_asset_form', ['title' => 'AIDA - Add New Asset']);
    }

    public function showEditAssetForm($asset_id)
    {
        $asset_data = DB::connection('mysql')
                    ->select('select aida.inventaris.* 
                    from aida.inventaris
                    where id_barang=?',[$asset_id]);

        return view('edit_asset_form', ['title' => 'AIDA - '.$asset_id, 'asset_data' => $asset_data[0]]);
    }

    public function showBulkUpload()
    {
        return view('bulk_upload', ['title' => 'AIDA - Bulk Upload']);
    }
}
