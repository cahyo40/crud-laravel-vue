<?php

namespace App\Http\Controllers;

use App\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data = Anggota::where('nama','LIKE',"%$search%")->orWhere('email','LIKE',"%$search%")->orWhere('alamat','LIKE',"%$search%")->paginate(10);
        return response()->json(['data' =>$data]);
    }
    public function index1($cari)
    {
        $data = Anggota::where('nama','LIKE',"%$cari%")->orWhere('email','LIKE',"%$cari%")->orWhere('alamat','LIKE',"%$cari%")->paginate(10);
        return response()->json(['data' =>$data]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required',
            'alamat'    =>  'required',
            'telepon'   =>  'required|numeric',
            'email'     =>  'required|email'
        ]);
        $store = Anggota::create($request->all());
        return response()->json($store);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pilih =  Anggota::findOrFail($id);
        return response()->json($pilih);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function edit(Anggota $anggota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ubah = Anggota::findOrFail($id)->update($request->all());
        return response()->json($ubah);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anggota  $anggota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Anggota::destroy($id);
    }
}
