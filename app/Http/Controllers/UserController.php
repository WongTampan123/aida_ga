<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function showPage()
    {
        if(session()->has('user')){
            return redirect('/dashboard');
        } else {
            if(session()->has('fail')){
                Alert::error('NIK/Password Salah', 'NIK atau Password yang Dimasukkan Salah, Silahkan Cek Kembali');
            }            
            return view('login_page', ["title" => "MOVES | LOGIN"]);
        }
        // return view('login_page');
    }

    public function login(Request $req)
    {
        $login_form = $req -> validate([
            'loginusername'=>'required',
            'loginpassword'=>'required'
        ]);
        $url="http://api.mitratel.co.id/ldap/telkom/api/apigwsit_v1.php";
        $post_data=http_build_query(
            array(
                'username' => $login_form['loginusername'],
                'password' => $login_form['loginpassword']
            )
        );
        $option=array(
            'http'=>array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $post_data
            )
        );
        $respon_raw=file_get_contents($url, false, stream_context_create($option));
        $respon=json_decode($respon_raw, false);

        if($respon->status){
            $user=DB::select('select * from hcm.users where nik_tg=?',[$login_form['loginusername']]);
            $strava_user = DB::select('select * from moves.strava_user where nik=?',[$login_form['loginusername']]);
            $user[0]->strava_user=count($strava_user)!=0? $strava_user[0]:null;
            $req->session()->put('user', $user[0]);
            $req->session()->regenerate();
            return redirect('/');
        } else {
            return redirect('/')->with('fail','NIK/Password Salah');
        }
    }
}
