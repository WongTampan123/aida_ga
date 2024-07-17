<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('dashboard', ["title" => "AIDA - Dashboard"]);
    }

    public function showDashboardCategory($category)
    {
        return view('dashboard_category', ["title" => "AIDA - ".ucfirst($category)." Category"]);
    }

    public function showAssetList($subcategory)
    {
        return view('asset_list', ["title" => "AIDA - ".ucfirst($subcategory)." List"]);
    }
    
    
}
