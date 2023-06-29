<?php

namespace App\Http\Controllers\layanan;

use Carbon\Carbon;
use App\Models\lampiran;
use App\Models\Transaksi;
use App\Models\master\Obat;
use Illuminate\Http\Request;
use App\Models\ImunisasiObat;
use App\Models\HistoryImunisasi;
use App\Models\layanan\Imunisasi;
use App\Models\master\PasienBayi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\master\JenisLayanan;
use Illuminate\Support\Facades\Auth;
use App\Models\ImunisasiJenisLayanan;

class ImunisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bayiArr = PasienBayi::where('status_hapus',0)->get();
        return view('layanan.bayi_imunisasi.index', compact('bayiArr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ambilNoKar = DB::select('SELECT * FROM layanan_imunisasi ORDER BY id DESC'); 
        $nokar = '';
        if($ambilNoKar)
            $nokar = 'IM'.date('dmY').($ambilNoKar[0]->id+1);
        else
            $nokar = 'IM'.date('dmY').'1';
        
        return view('layanan.bayi_imunisasi.tambah',compact('nokar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $no_kartu = $request->txtNoKar;
            $nama = $request->txtNama;
            $tgl_lahir = date("Y-m-d", strtotime($request->dtpTanggalLahir));
            $bbl = str_replace(",", ".", $request->txtBbl);
            $cara_persalinan = $request->cbxPersalinan;
            $alamat = $request->txtAlamat;
            $nama_ayah = $request->txtNamaAyah;
            $nama_ibu = $request->txtNamaIbu;
            $telp = $request->txtTelp;
            $kelurahan = $request->txtKelurahan;
            $asal_wilayah = $request->txtAsalWilayah;
            $kelamin = $request->cbxKelamin;

            $jenis_paket = $request->txtPaket;

            // IDENTITAS
            $new_pas_bay = new PasienBayi();
            $new_pas_bay->nama = $nama;
            $new_pas_bay->kelamin = $kelamin;
            $new_pas_bay->tanggal_lahir = $tgl_lahir;
            $new_pas_bay->bbl = $bbl;
            $new_pas_bay->cara_persalinan = $cara_persalinan;
            $new_pas_bay->kelurahan = $kelurahan;
            $new_pas_bay->asal_wilayah = $asal_wilayah;
            $new_pas_bay->alamat = $alamat;
            $new_pas_bay->nama_ayah = $nama_ayah;
            $new_pas_bay->nama_ibu = $nama_ibu;
            $new_pas_bay->telp = $telp;
            $new_pas_bay->status_hapus = 0;
            $new_pas_bay->users_id = Auth::user()->id;
            $new_pas_bay->save();
            $id_new_pas_bay = $new_pas_bay->id;

            $new_imunisasi  = new Imunisasi();
            $new_imunisasi->no_kartu = $no_kartu;
            $new_imunisasi->id_pasien_bayi = $id_new_pas_bay;
            $new_imunisasi->jenis_paket = $jenis_paket;
            $new_imunisasi->status_pasien = 0;
            $new_imunisasi->save();
            $id_new_imunisasi = $new_imunisasi->id;

            //JADWAL
            $layanan_all = JenisLayanan::where('pelayanan',$jenis_paket)->where('status_hapus',0)->get();
            foreach ($layanan_all as $key => $value) {
                if($request->input('dtp'.$layanan_all[$key]->id) != 'NULL')
                {
                    $new_imunisasi_layanan = new ImunisasiJenisLayanan();
                    $new_imunisasi_layanan->id_layanan_imunisasi = $id_new_imunisasi;
                    $new_imunisasi_layanan->id_jenis_layanan = $value->id;
                    $new_imunisasi_layanan->tanggal = date("Ymd", strtotime($request->input('dtp'.$layanan_all[$key]->id)));
                    $new_imunisasi_layanan->status_imunisasi = 0;
                    $new_imunisasi_layanan->save();
                }
                
            }

            //LAMPIRANNYA
            if ($request->file('lampiran')) {
                foreach ($request->file('lampiran') as $key => $value) {
                    $image = $value;
                    $extensions = $value->getClientOriginalExtension();
                    $filenameToSave = "lampiran_IM_".$id_new_imunisasi."_".date("Ymd", strtotime(Carbon::now()))."_".($key+1).".".$extensions;
                    $destinationPath = public_path('lampiran');
                    $imagePath = "lampiran/".  $filenameToSave;
                    $image->move($destinationPath, $filenameToSave);

                    $new_lampiran = new lampiran();
                    $new_lampiran->jenis_layanan = $jenis_paket;
                    $new_lampiran->id_layanan = $id_new_imunisasi;
                    $new_lampiran->tanggal = date("Y-m-d", strtotime(Carbon::now()));
                    $new_lampiran->url_gambar = $imagePath;
                    $new_lampiran->no_registrasi_pasien = $id_new_pas_bay;
                    $new_lampiran->save();
                }
            }

            DB::commit();
            return redirect('/layanan-imunisasi/')->with(['message'=>'Imunisasi berhasil disimpan.']);
        } catch (\Exception $ex){
            DB::rollback();
            // dd($ex->getMessage());
            return redirect('/layanan-imunisasi/')->with(['message'=>'Imunisasi Gagal disimpan.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imunisasi  $imunisasi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $bayiArr = PasienBayi::where('id', '=', $id)->get();
        
        $history = HistoryImunisasi::where('pasien_bayi_id',$bayiArr[0]->id)->get();
  
        // $layanan_imunisasi = DB::table('layanan_imunisasi')->where('no_registrasi', '=', $bayi[0]->no_registrasi)->get();
        $layanan_hist = Imunisasi::where('id_pasien_bayi',$bayiArr[0]->id)->get();
        return view('layanan.bayi_imunisasi.history', compact(['bayiArr','history']), compact('layanan_hist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imunisasi  $imunisasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bayiArr = PasienBayi::where('id', $id)->get();
        $layanan_imunisasiArr = Imunisasi::where('id_pasien_bayi',$bayiArr[0]->id)->get();
        $jadwalArr = ImunisasiJenisLayanan::where('id_layanan_imunisasi',$layanan_imunisasiArr[0]->id)->get();
        return view('layanan.bayi_imunisasi.edit', compact('bayiArr'), compact('jadwalArr'), compact('layanan_imunisasiArr'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imunisasi  $imunisasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Imunisasi $imunisasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imunisasi  $imunisasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Imunisasi $imunisasi)
    {
        //
    }

 
    
    public function indexHistoryTambah(Request $request)
    {
        $bayiArr = PasienBayi::where('id', '=', $request->txtId)->get();
        $konfirmasiJadwal = array();
        $konfirmasiJadwal[0]['tanggalnya'] = $request->dtpTanggal;
        $konfirmasiJadwal[0]['id_layanannya'] = $request->txtIdLayanan;
        $konfirmasiJadwal[0]['id'] = $request->txtId;
        return view('layanan.bayi_imunisasi.history_tambah', compact('bayiArr'), compact('konfirmasiJadwal'));
    }
    public function storeHistory(Request $request)
    {
        DB::beginTransaction();
        try{
            $arrObat = explode(";", $request->obatnya);
            $idObat = explode(",", $arrObat[0]);
            $qtyObat = explode(",", $arrObat[1]);
          
            
            
            $imunisasi =  Imunisasi::where('id_pasien_bayi',$request->noregKonf)->first();
            $id_layanan = $imunisasi->id;
            $imunisasi_jenis_layanan_update = ImunisasiJenisLayanan::where('id_layanan_imunisasi',$id_layanan)->where('id_jenis_layanan',$request->idLayananKonf)->first();
            // dd($imunisasi_jenis_layanan_update);
            $imunisasi_jenis_layanan_update->status_imunisasi = 1;
            $imunisasi_jenis_layanan_update->tanggal = date("Y-m-d");
            $imunisasi_jenis_layanan_update->save();
           
            if($idObat[0]!=null){
                foreach ($idObat as $key => $value) {
                    $obat = Obat::find($value);
                    $ttl_hrg_obt = $obat->harga*(int)$qtyObat[$key];
                    $stok_update = $obat->total_pcs-(int)$qtyObat[$key];
                    $obat->total_pcs = $stok_update;
                    $obat->save();
                    $new_imunisasi_obat = new ImunisasiObat();
                    $new_imunisasi_obat->id_obat = $value;
                    $new_imunisasi_obat->id_layanan = $request->idLayananKonf;
                    $new_imunisasi_obat->qty = $qtyObat[$key];
                    $new_imunisasi_obat->save();
                }
            }

            $layanan = JenisLayanan::find($request->idLayananKonf);
            // dd($layanan->id);
            $new_history_imunisasi = new HistoryImunisasi();
            $new_history_imunisasi->id_layanan_imunisasi = $id_layanan;
            $new_history_imunisasi->tanggal = $imunisasi_jenis_layanan_update->tanggal;
            $new_history_imunisasi->status_hapus = 0;
            $new_history_imunisasi->pasien_bayi_id = $request->noregKonf;
            $new_history_imunisasi->bb = str_replace(",", ".", $request->bbnya);
            $new_history_imunisasi->keluhan = $request->keluhannya;
            $new_history_imunisasi->nasehat = $request->nasehatnya;
            $new_history_imunisasi->umur = $request->umurnya;
            $new_history_imunisasi->pengobatan = $layanan->nama;
            $new_history_imunisasi->tarif_layanan_tambahan = str_replace(",", "", $request->harga_layanannya);
            $new_history_imunisasi->total_akhir = str_replace(",", "", $request->totalAkhirnya);
            $new_history_imunisasi->users_id  = Auth::user()->id;
            $new_history_imunisasi->save();
            // 
            // INSERT DB TRANSAKSI
            $new_transaksi = new Transaksi();
            $new_transaksi->jenis_layanan = $imunisasi->jenis_paket;
            $new_transaksi->id_layanan = $imunisasi->id;
            $new_transaksi->harga_obat = (float)str_replace(",", "", $request->totalAkhirnya)-((float)str_replace(",", "", $request->harga_layanannya)+$request->harga_layanan_paketnya);
            $new_transaksi->harga_layanan =((float)str_replace(",", "", $request->harga_layanannya)+$request->harga_layanan_paketnya);
            $new_transaksi->total_harga = str_replace(",", "", $request->totalAkhirnya);
            $new_transaksi->tanggal = date("Y-m-d H:i:s");
            $new_transaksi->users_id = Auth::user()->id;
            $new_transaksi->save();
            
            $id_pasien = PasienBayi::where('id',$request->noregKonf)->get();
            DB::commit();
            return redirect('/layanan-imunisasi/'.$id_pasien[0]->id);
        } catch (\Exception $ex){
            DB::rollback();
            dd($ex->getMessage());
            return redirect('/layanan-imunisasi/')->back()->with(['danger_message'=>'Gagal menyimpan history pasen imunisasi.']);
        }
        
    }

    public function cek_stok_obat(Request $request){
        $arrObat = explode(";", $request->obatnya);
        $idObat = explode(",", $arrObat[0]);
        $qtyObat = explode(",", $arrObat[1]);
        $error = array();
        foreach ($idObat as $key => $value) {
            $obatnya = Obat::find($value);
            if($qtyObat[$key] > $obatnya->total_pcs){
                array_push($error, $obatnya->nama." melebihi stok (".$obatnya->total_pcs.") <br>");
            }
        }
        if(count($error)==0){
            echo "";
        }
        else{
            $hasilnya = implode(" ", $error);
            echo $hasilnya;
        }
    }
    
    public function indexTambahKartu($id)
    {
        $bayiArr =  PasienBayi::where('id', '=', $id)->get();
        return view('layanan.bayi_imunisasi.tambah_kartu', compact('bayiArr'));
    }

    public function tambahPasienKartu(Request $request)
    {
        DB::beginTransaction();
        try {
            $ambilNoKar = DB::select('SELECT * FROM layanan_imunisasi ORDER BY id DESC'); 
            if($ambilNoKar)
                $no_kartu = 'IM'.date('dmY').($ambilNoKar[0]->id+1);
            else
                $no_kartu = 'IM'.date('dmY').'1';

            $jenis_paket = $request->txtPaket;
            $no_registrasi = $request->txtNoReg;

            $created_by = Auth::user()->id;
            $created_at = Carbon::now();
            $updated_by = Auth::user()->id;
            $updated_at = Carbon::now();

            $new_layanan_imunisasi = new Imunisasi();
            $new_layanan_imunisasi->no_kartu = $no_kartu;
            $new_layanan_imunisasi->id_pasien_bayi = $no_registrasi;
            $new_layanan_imunisasi->jenis_paket = $jenis_paket;
            $new_layanan_imunisasi->status_pasien = 0;
            $new_layanan_imunisasi->save();
            $id_new_layanan_imunisasi = $new_layanan_imunisasi->id;


            //JADWAL
            $layanan_all = JenisLayanan::where('pelayanan',$jenis_paket)->where('status_hapus',0)->get();
            foreach ($layanan_all as $key => $value) {
                if($request->input('dtp'.$layanan_all[$key]->id) != 'NULL')
                {
                    $new_imunisasi_jenis_layanan = new ImunisasiJenisLayanan();
                    $new_imunisasi_jenis_layanan->id_layanan_imunisasi = $id_new_layanan_imunisasi;
                    $new_imunisasi_jenis_layanan->id_jenis_layanan = $value->id;
                    $new_imunisasi_jenis_layanan->tanggal = date("Ymd", strtotime($request->input('dtp'.$layanan_all[$key]->id)));
                    $new_imunisasi_jenis_layanan->status_imunisasi = 0;
                    $new_imunisasi_jenis_layanan->save();
                }
            }
            
            //LAMPIRANNYA
            if ($request->file('lampiran')) {
                foreach ($request->file('lampiran') as $key => $value) {

                    $image = $value;
                    $extensions = $value->getClientOriginalExtension();
                    $filenameToSave = "lampiran_IM_".$no_registrasi."_".date("Ymd", strtotime(Carbon::now()))."_".($key+1).".".$extensions;
                    $destinationPath = public_path('lampiran');
                    $imagePath = "lampiran/".  $filenameToSave;
                    $image->move($destinationPath, $filenameToSave);;
                    
                    $new_lampiran = new lampiran();
                    $new_lampiran->jenis_layanan = $jenis_paket;
                    $new_lampiran->id_layanan = $id_new_layanan_imunisasi;
                    $new_lampiran->tanggal = date("Y-m-d", strtotime(Carbon::now()));
                    $new_lampiran->url_gambar = $imagePath;
                    $new_lampiran->no_registrasi_pasien = $no_registrasi;
                    $new_lampiran->save();
                }
            }

            $bayiArr = PasienBayi::where('status_hapus', '=', 0)->orderBy('id','desc')->get();
            DB::commit();
            return view('layanan.bayi_imunisasi.index', compact('bayiArr'));
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect()->back()->with(['notif_gagal'=>'Data pasien gagal disimpan']);
        }
    }

    public function cetakKartu($id)
    {
        $bayi = PasienBayi::where('status_hapus', '=', 0)->where('id','=',$id)->get();

        // $pdf = PDF::loadView(
        //     'layanan.cetak_kartu_imunisasi', 
        //     [
        //         'bayi' => $bayi
        //     ]
        // );

        // // return view('layanan\cetak_kartu_imunisasi', compact('bayi'));
        // return $pdf->stream('kartu.pdf');
    }

    public function storeImportObservasi(Request $request)
    {
        $no_regis = $request->input('no_regis');
        $id_jenis_layanan = $request->input('id_layanan');
        $id_bayi = $request->input('id_bayi');
        DB::beginTransaction();
        try {
            if ($request->file('lampiranobservasi')) {
                foreach ($request->file('lampiranobservasi') as $key => $value) {
                    $image = $value;
                    $extensions = $value->getClientOriginalExtension();
                    $filenameToSave = "lampiran_IM_".$no_regis."_".date("YmdHis")."_".($key+1).".".$extensions;
                    $destinationPath = public_path('/lampiran');
                    $imagePath = "lampiran/". $filenameToSave;
                    $image->move($destinationPath, $filenameToSave);;

                    $new_lampiran = new lampiran();
                    $new_lampiran->jenis_layanan = '0';
                    $new_lampiran->id_layanan = $id_jenis_layanan;
                    $new_lampiran->tanggal = date('Y-m-d');
                    $new_lampiran->url_gambar = $imagePath;
                    $new_lampiran->no_registrasi_pasien = $no_regis;
                    $new_lampiran->save();
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/layanan-imunisasi/'.$id_bayi)->with(['danger_message'=>'Lampiran gagal disimpan.']);
        }

        return redirect('/layanan-imunisasi/'.$id_bayi)->with(['message'=>'Lampiran berhasil disimpan.']);
    }

    public function reschedule(Request $request)
    {
        DB::beginTransaction();
        try{
            // dd($request->txtNoRegRes);
            $layanan_imunisasi = Imunisasi::where('id_pasien_bayi',$request->txtNoRegRes)->first();
            $imunisasi_jenis_layanan = ImunisasiJenisLayanan::where('id_layanan_imunisasi',$layanan_imunisasi->id)->where('id_jenis_layanan', $request->txtJenisLayananRes)->first();
            $imunisasi_jenis_layanan->tanggal = date("Y-m-d", strtotime($request->txtTanggalRes));
            $imunisasi_jenis_layanan->save();
            DB::commit();
        } catch (\Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['notif_gagal'=>'Reschedule tidak dapat diproses']);
        }
        return redirect()->back()->with('notif_berhasil', 'Reschedule berhasil diproses');
    }

}
