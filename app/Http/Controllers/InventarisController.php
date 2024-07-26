<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventarisController extends Controller
{
    public function saveNewAsset(Request $request)
    {
        $request_validation = $request->validate([
            'jenis_barang' => 'required',
            'tipe_barang' => 'required',
            'kode_barang' => 'required',
            'lantai_barang' => 'required',
            'ruangan_barang' => 'required',
            'unit_barang' => 'required'
        ]);
        
        $image=$request->file('gambar_barang');
        $image_name = $request->input('kode_barang').'.'.$image->extension();
        $path=$image->move(public_path().'/assets/gambar_barang/',$image_name);

        DB::connection('mysql')->insert('insert into aida.inventaris(id_barang, jenis_barang, tipe_barang, quantity_barang, merk_barang, lantai_barang, ruangan_barang, tahun_barang, unit_barang, gambar_barang) 
            value(?,?,?,?,?,?,?,?,?,?)',[
            $request->input('kode_barang'),
            $request->input('jenis_barang'),
            $request->input('tipe_barang'),
            $request->input('quantity_barang'),
            $request->input('merk_barang'),
            $request->input('lantai_barang'),
            $request->input('ruangan_barang'),
            $request->input('tahun_barang'),
            $request->input('unit_barang'),
            $image_name
        ]);

        return response()->json(['message'=>'input berhasil']);
    }

    public function updateAsset(Request $request)
    {
        $image=$request->file('gambar_barang');
        $image_name=$request->input('kode_barang').'.'.$image->extension();
        $path=$image->move(public_path().'/assets/gambar_barang/',$image_name);

        DB::connection('mysql')->update('update aida.inventaris
                                        set id_barang=?, jenis_barang=?, tipe_barang=?, quantity_barang=?, merk_barang=?, lantai_barang=?, ruangan_barang=?, tahun_barang=?, unit_barang=?, gambar_barang=?
                                        where aida.inventaris.id=?',[
            $request->input('kode_barang'),
            $request->input('jenis_barang'),
            $request->input('tipe_barang'),
            $request->input('quantity_barang'),
            $request->input('merk_barang'),
            $request->input('lantai_barang'),
            $request->input('ruangan_barang'),
            $request->input('tahun_barang'),
            $request->input('unit_barang'),
            $image_name,
            $request->input('id')
        ]);

        return response()->json(['message'=>'input berhasil']);

    }
}
