<?php

namespace App\Http\Controllers\master;

use App\Models\master\Obat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ObatController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        //
        $obat = Obat::where( 'status_hapus',  0 )->orderBy( 'id', 'desc' )->get();
        // dd( $obat );
        return view( 'master.obat.index', compact( 'obat' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        try {
            $total_pcs = $request->txtSatuan == 0 ? 1 : $request->txtPcs;
            $harganya = ( int )str_replace( ',', '', $request->txtHarga );
            $harga = $request->txtSatuan == 0 ? $harganya : $harganya/$request->txtPcs;
            $obat = new Obat();
            $obat->nama = $request->txtNama;
            $obat->kode_obat = $request->txtKode;
            $obat->merk = $request->txtMerk;
            $obat->harga = $harga;
            $obat->catatan = $request->txtCttn;
            $obat->pcs = $total_pcs;
            $obat->total_pcs = $total_pcs*$request->txtStok;
            $obat->id_satuan = $request->txtSatuan;
            $obat->tanggal_kadaluarsa = date( 'Y-m-d', strtotime( $request->tglkadaluarsa ) );
            $obat->status_hapus = 0;
            $obat->users_id = 4;
            $obat->save();
            // $obat->create_ = 1
            return redirect()->back()->with( 'message', 'Data Obat berhasil disimpan.' );
        } catch ( \Throwable $th ) {
            //throw $th;
            // dd( $th );
            return redirect()->back()->with( 'message', 'Data Obat gagal ditambahkan.'.$th );

        }

    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Obat  $obat
    * @return \Illuminate\Http\Response
    */

    public function show( Obat $obat ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Obat  $obat
    * @return \Illuminate\Http\Response
    */

    public function edit( Obat $obat ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Obat  $obat
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, Obat $obat ) {
        //
        try {
            $jenis = $request->jenis_update;
            if ( $jenis == 'data_all' ) {
                $obat->nama = $request->txtNamaEdit;
                $obat->kode_obat = $request->txtKodeEdit;
                $obat->merk = $request->txtMerkEdit;
                $obat->catatan = $request->txtCttnEdit;
                $obat->tanggal_kadaluarsa = date( 'Y-m-d', strtotime( $request->tglkadaluarsaEdit ) );
                $obat->save();
                return redirect()->back()->with( 'message', 'Data Obat berhasil diganti.' );
            } else if ( $jenis == 'data_harga' ) {
                $harganya = ( int )str_replace( ',', '', $request->txtHargaEdit );
                $harga = $harganya/$obat->pcs;
                $obat->harga = $harga;
                $obat->save();
                return redirect()->back()->with( 'message', 'Harga Obat berhasil diganti.' );
            } else if ( $jenis == 'data_tambah_stok' ) {
                $stok_saat_ini = $obat->total_pcs;
                $stok_update = $stok_saat_ini + ( $request->txtSatuanJmlTambah == 0 ? $request->txtJmlTambah : $request->txtJmlTambah*$obat->psc );
                $obat->total_pcs = $stok_update;
                $obat->save();
                return redirect()->back()->with( 'message', 'Stok Obat berhasil ditambah.' );
            } else {
                $stok_saat_ini = $obat->total_pcs;
                $stok_update = $stok_saat_ini - ( $request->txtSatuanJmlKurang == 0 ? $request->txtJmlKurang : $request->txtJmlKurang*$obat->pcs );
                $obat->total_pcs = $stok_update;
                $obat->save();
                return redirect()->back()->with( 'message', 'Stok Obat berhasil dikurangi.' );
            }
        } catch ( \Throwable $e ) {
            return redirect()->back()->with( 'message', 'Data Obat Gagal Di Update.' );
        }

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Obat  $obat
    * @return \Illuminate\Http\Response
    */

    public function destroy( Request $request, $obat ) {
        //
        try {
            $jenis_hapus = $request->jenis_hapus;
            // dd( $request->txtDeleteAll );
            if ( $jenis_hapus == 'all' ) {
                Obat::whereIn( 'id', $request->txtDeleteAll )->update(
                    [
                        'status_hapus' => 1,
                    ] );
                    return redirect()->back()->with( 'message', 'Data Obat berhasil dihapus.' );

                } else {
                    $obat = Obat::find( $obat );
                    $obat->status_hapus = 1;
                    $obat->save();
                    return redirect()->back()->with( 'message', 'Data Obat berhasil dihapus.' );
                }
            } catch ( \Throwable $th ) {
                return redirect()->back()->with( 'message', 'Data Obat gagal dihapus.' );
            }
        }
    }
