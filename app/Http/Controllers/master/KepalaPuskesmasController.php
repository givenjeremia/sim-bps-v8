<?php

namespace App\Http\Controllers\master;

use App\Models\master\KepalaPuskesmas;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KepalaPuskesmasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kepala_puskesmas = KepalaPuskesmas::where('status_hapus', 0)->get();
        return view('master.kepala_puskesmas.index', compact('kepala_puskesmas')); 

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            KepalaPuskesmas::where('status_aktif', 1)->update(['status_aktif' => 0]);
            
            $kepalaPuskesmas = new KepalaPuskesmas();
            $kepalaPuskesmas->nip = $request->txtNIP;
            $kepalaPuskesmas->nama = $request->txtNama;
            $kepalaPuskesmas->kelurahan = $request->txtKelurahan;
            $kepalaPuskesmas->status_aktif = 1;
            $kepalaPuskesmas->status_hapus = 0;
            $kepalaPuskesmas->save();
            return redirect()->back()->with(['message'=>'Data Kepala Puskesmas berhasil disimpan.']);
        } catch (\Throwable $e) {
            dd($e);
            return redirect()->back()->with(['danger_message'=>'Data Kepala Puskesmas gagal disimpan.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KepalaPuskesmas  $kepalaPuskesmas
     * @return \Illuminate\Http\Response
     */
    public function show(KepalaPuskesmas $kepalaPuskesmas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KepalaPuskesmas  $kepalaPuskesmas
     * @return \Illuminate\Http\Response
     */
    public function edit(KepalaPuskesmas $kepalaPuskesmas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KepalaPuskesmas  $kepalaPuskesmas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kepalaPuskesmas)
    {
        //
        $kepalaPuskesmas = KepalaPuskesmas::find($kepalaPuskesmas);
        try {
            if($request->statusEdit){
                KepalaPuskesmas::where('status_aktif', 1)->update(['status_aktif' => 0]);
                $kepalaPuskesmas->nip = $request->txtNIPEdit;
                $kepalaPuskesmas->nama = $request->txtNamaEdit;
                $kepalaPuskesmas->kelurahan = $request->txtKelurahanEdit;
                $kepalaPuskesmas->status_aktif = $request->statusEdit;
                $kepalaPuskesmas->save();
            }
            else{
                $kepalaPuskesmas->nip = $request->txtNIPEdit;
                $kepalaPuskesmas->nama = $request->txtNamaEdit;
                $kepalaPuskesmas->kelurahan = $request->txtKelurahanEdit;
                $kepalaPuskesmas->save();
            }
            return redirect()->back()->with(['message'=>'Data Kepala Puskesmas berhasil diganti.']);
        } catch (\Throwable $e) {
            return redirect()->back()->with(['danger_message'=>'Data Kepala Puskesmas gagal diganti.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KepalaPuskesmas  $kepalaPuskesmas
     * @return \Illuminate\Http\Response
     */
    public function destroy(KepalaPuskesmas $kepalaPuskesmas)
    {
        //
    }
}
