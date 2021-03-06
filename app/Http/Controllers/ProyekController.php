<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ProyekController extends Controller
{
    //
    public function karyawan($value='')
    {
    	$list = DB::table('pegawai')->get();
        return view('proyek.karyawan', ['list' => $list]);
    }

    public function karyawanProyek($id='')
    {
    	$list = DB::table('proyek')->where('id_pegawai',$id)->get();
        return view('proyek.karyawanProyek', ['list' => $list]);
    }

    public function index($value='')
    {
    	$list = DB::table('proyek')->get();
        return view('proyek.list', ['list' => $list]);
    }

    
    function show($id=0)
    {
        $list = DB::table('proyek')->where('id',$id)
        ->get();
        return view('proyek.proyekId', ['list' => $list]);
    }

    function edit($id=0)
    {
        $post = DB::table('proyek')->where('id',$id)
        ->first();
        return view('proyek.edit_proyek', compact('post'));
    }

    function create()
    {
        return view('proyek.form_proyek');
    }

    function store(Request $request)
    {
    	$validatedData = $request->validate([
	        'nama_proyek' => 'required|unique:proyek',
	        'deskripsi' => 'required',
	        'tglm' => 'required',
	        'tgld' => 'required',
    	]);

		DB::table('proyek')->insert(
		    [
		    	'nama_proyek' => $request->nama_proyek, 
		    	'deskripsi' => $request->deskripsi,
		    	'tanggal_mulai' => $request->tglm,
		    	'tanggal_deadline' => $request->tgld,
		    	'id_pegawai' => 1,
		    ]
		);
		
    	return redirect('proyek')->with("success",'data berhasil disimpan');
    }

    function update($id,Request $request)
    {
        $validatedData = $request->validate([
            'nama_proyek' => 'required|unique:proyek',
	        'deskripsi' => 'required',
	        'tglm' => 'required',
	        'tgld' => 'required',
        ]);

        DB::table('proyek')
        ->where('id', $id)
        ->update(
            [
                'nama_proyek' => $request->nama_proyek, 
		    	'deskripsi' => $request->deskripsi,
		    	'tanggal_mulai' => $request->tglm,
		    	'tanggal_deadline' => $request->tgld,
		    	'id_pegawai' => 1,
            ]
        );
        
        return redirect('proyek')->with("success",'data berhasil disimpan');
    }

    function destroy($id)
    {
        DB::table('proyek')
        ->where('id', $id)
        ->delete();
        
        return redirect('proyek')->with("success",'data berhasil dihapus');
    }
}
