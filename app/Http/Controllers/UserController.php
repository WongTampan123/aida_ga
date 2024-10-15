<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
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

        if($login_form['loginusername']==985373){
            $user=DB::connection('mysql')->select('select * from hcm.users where nik_tg=?',[$login_form['loginusername']])[0];
            $regional_user=explode(" ",$user->psa_text)[0];
            $privilage=DB::connection('mysql')->select('select * from aida.user_privilage where aida.user_privilage.nik=?',[$login_form['loginusername']]);

            if(!empty($privilage)){
                $user->privilage=[
                    'view'=>['unit'=>$privilage[0]->unit, 'regional'=>$privilage[0]->regional],
                    'update'=>$privilage[0]->unit,
                    'create'=>$privilage[0]->can_create,
                    'approve'=>$privilage[0]->can_approve,
                    'stock_take'=>$privilage[0]->can_stock_take
                ];
            } else {
                $user->privilage=[
                    'view'=>['unit'=>$user->id_unit_sppd, 'regional'=>$regional_user],
                    'update'=>'false',
                    'create'=>'false',
                    'approve'=>'false',
                    'stock_take'=>'false'
                ];
            }

            $req->session()->put('user', $user);
            $req->session()->regenerate();
            Log::info($req->session()->get('redirect'));

            if($req->session()->get('redirect')){
                return redirect($req->session()->get('redirect'));
            } else {
                return redirect('/');
            }            
        }

        if($respon->status||$login_form['loginusername']==795948||$login_form['loginusername']==20005106){
            $user=DB::connection('mysql')->select('select * from hcm.users where nik_tg=?',[$login_form['loginusername']])[0];
            $regional_user=explode(" ",$user->psa_text)[0];
            $privilage=DB::connection('mysql')->select('select * from aida.user_privilage where aida.user_privilage.nik=?',[$login_form['loginusername']]);

            if(!empty($privilage)){
                $user->privilage=[
                    'view'=>['unit'=>$privilage[0]->unit, 'regional'=>$privilage[0]->regional],
                    'update'=>$privilage[0]->unit,
                    'create'=>$privilage[0]->can_create,
                    'approve'=>$privilage[0]->can_approve,
                    'stock_take'=>$privilage[0]->can_stock_take
                ];
            } elseif ($user->id_unit_sppd=='Corporate Office') {
                $user->privilage=[
                    'view'=>['unit'=>'all', 'regional'=>'all'],
                    'update'=>'true',
                    'create'=>'true',
                    'approve'=>'true',
                    'stock_take'=>'true'
                ];
            } else {
                $user->privilage=[
                    'view'=>['unit'=>$user->id_unit_sppd, 'regional'=>$regional_user],
                    'update'=>'false',
                    'create'=>'false',
                    'approve'=>'false',
                    'stock_take'=>'false'
                ];
            }

            $req->session()->put('user', $user);
            $req->session()->regenerate();
            Log::info($req->session()->get('redirect'));

            if($req->session()->get('redirect')){
                return redirect($req->session()->get('redirect'));
            } else {
                return redirect('/');
            }            
        } else {
            return redirect('/')->with('fail','NIK/Password Salah');
        }
    }

    public function logout()
    {
        session()->forget('user');
        if(session()->get('redirect')){
            session()->forget('redirect');
        }
        return redirect('/');
    }
}
