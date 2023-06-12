<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\master\PasienDewasa;

class PasienDewasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pasien_dewasa = PasienDewasa::where('status_hapus', '<>', 1)->orderBy('id', 'desc')->first();
        $noreg = (!empty($pasien_dewasa)) ? 'OD'.date("Ymd").($pasien_dewasa->id + 1) : 'OD'.date("Ymd")."1";
        $pasien = DB::select('SELECT pd.no_registrasi no_registrasi, pd.nama nama_ibu, spd.nama nama_ayah, pd.alamat alamat_ibu, pd.telp phone_ibu, pd.id id FROM pasien_dewasa pd LEFT JOIN (SELECT MAX(id) id_max, id_pasien_dewasa, nama FROM suami_pasien_dewasa GROUP BY id_pasien_dewasa, nama) spd ON spd.id_pasien_dewasa = pd.id WHERE pd.status_hapus <> 1');
        $pasienArr = json_decode(json_encode($pasien), true);
        return view('master.pasiendewasa', compact(['pasienArr', 'noreg']));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PasienDewasa  $pasienDewasa
     * @return \Illuminate\Http\Response
     */
    public function show(PasienDewasa $pasienDewasa)
    {
        //
        return view('master.pasiendewasadetail', compact(['pasienDewasa']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PasienDewasa  $pasienDewasa
     * @return \Illuminate\Http\Response
     */
    public function edit(PasienDewasa $pasienDewasa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PasienDewasa  $pasienDewasa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PasienDewasa $pasienDewasa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PasienDewasa  $pasienDewasa
     * @return \Illuminate\Http\Response
     */
    public function destroy(PasienDewasa $pasienDewasa)
    {
        //
    }
}
