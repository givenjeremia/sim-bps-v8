<?php

namespace App\Http\Controllers\layanan;

use App\Models\HistoryKB;
use App\Models\lampiran;
use App\Models\Transaksi;
use App\Models\layanan\Kb;
use App\Models\master\Obat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\master\JenisLayanan;
use App\Models\master\PasienDewasa;
use Illuminate\Support\Facades\Auth;
use App\Models\master\SuamiPasienDewasa;

class KbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $layanankbArr = PasienDewasa::with('kb')
        ->where('status_hapus', '<>', 1)
        ->get();
            
        return view('layanan.KB.index', compact('layanankbArr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $layanan =  JenisLayanan::where('status_hapus','<>',1)->where('pelayanan',0)->get();
        $noreg = PasienDewasa::generateNoRegister();
        
        return view('layanan.KB.tambah', compact(["layanan", "noreg"]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $noKartu = DB::table('layanan_kb')->orderBy('id', 'desc')->first();
        $nomor = (!empty($noKartu)) ? 'KB'.date("Ymd").($noKartu->id + 1) : 'KB'.date("Ymd")."1";

        $status_peserta = $request->input('txtStatusKb');
        $tgl_status_peserta = date("Y-m-d", strtotime($request->input('txtTglStatusKb')));
        $jumlah_anak_laki = $request->input('txtAnakLaki');
        $jumlah_anak_perempuan = $request->input('txtAnakPerempuan');
        $ku = $request->input('txtKU');
        $haid_terakhir = date("Y-m-d", strtotime($request->input('txtHaidTerakhir')));
        $sakit_kuning = $request->input('txtSakitKuning');
        $perd_per_vag = $request->input('txtPerVag');
        $tumor_payudara = $request->input('txtTumorPayudara');
        $fluoralbus = $request->input('txtFluoralbus');
        $id_jenis_layanan = $request->input('cboJenisKB');
        $tgl_dilayani = date("Y-m-d", strtotime($request->input('txtTglLayani')));
        $tgl_datang_kembali = date("Y-m-d", strtotime($request->input('txtTglPesanKemb')));
        $tgl_lepas = date("Y-m-d", strtotime($request->input('txtTglLepas')));
        $tensi_atas = $request->input('txtTensiAtas');
        $tensi_bawah = $request->input('txtTensiBawah');
        $bb = str_replace(",", ".", $request->input('txtBeratBadan'));
        $tanda_radang = $request->input('txtTandaRadang');
        $tumor = $request->input('txtTumor');
        $posisi_rahim = $request->input('txtPosisiRahim');
        $genetalia_luar_dalam = $request->input('txtGenetalia');
        $total_obat = $request->input('txtTotalObat');
        $total_layanan = $request->input('txtTarifLayanan');
        $total_bayar = $request->input('txtTarifTotal');
        
        $no_regis = "";
        $pasienid = "";
  
        DB::beginTransaction();
        try{
            if($request->input('tipe') != 'buat_kartu'){
                $no_regis = $request->input("txtNoregis");
                $new_pasien_dewasa = new PasienDewasa();
                $new_pasien_dewasa->no_regis = $no_regis;
                $new_pasien_dewasa->nama = $request->input("txtNamaibu");
                $new_pasien_dewasa->tanggal_lahir = date("Y-m-d", strtotime($request->input("txtTanggalLahiribu")));
                $new_pasien_dewasa->agama = $request->input("txtAgamaibu");
                $new_pasien_dewasa->alamat = $request->input("txtAlamatibu");
                $new_pasien_dewasa->telp = $request->input("txtPhoneibu");
                $new_pasien_dewasa->kelurahan = $request->input("txtKelurahanibu");
               
                $new_pasien_dewasa->pekerjaan = $request->input("txtPekerjaanibu");
                $new_pasien_dewasa->pendidikan = $request->input("txtPendidikanibu");
                $new_pasien_dewasa->buku_kia = "belum";
                $new_pasien_dewasa->tgl_buku_kia = NULL;
                $new_pasien_dewasa->status_hapus = 0;
                $new_pasien_dewasa->save();

                $id_new_pasien_dewasa = $new_pasien_dewasa->no_regis;

                $tgl_lahir_ayah = "";
                if($request->input("chkTgl") == "on"){
                    $tgl_lahir_ayah = date("Y-m-d", strtotime($request->input("0000-00-00")));
                }
                else{
                    $tgl_lahir_ayah = date("Y-m-d", strtotime($request->input("txtTanggalLahirayah")));
                }

                $new_suami_pasien_dewasa = new SuamiPasienDewasa();
                $new_suami_pasien_dewasa->nama = $request->input("txtNamaayah");
                $new_suami_pasien_dewasa->tanggal_lahir = $tgl_lahir_ayah;
                $new_suami_pasien_dewasa->agama = $request->input("txtAgamaayah");
                $new_suami_pasien_dewasa->alamat = $request->input("txtAlamatibu");
                $new_suami_pasien_dewasa->telp = $request->input("txtPhoneibu");
                $new_suami_pasien_dewasa->kelurahan = $request->input("txtKelurahanibu");
                $new_suami_pasien_dewasa->pekerjaan = $request->input("txtPekerjaanayah");
                $new_suami_pasien_dewasa->pendidikan = $request->input("txtPendidikanayah");
                $new_suami_pasien_dewasa->nikah_ke = '2';
                $new_suami_pasien_dewasa->no_regis_pasien_dewasa  = $id_new_pasien_dewasa;
                $new_suami_pasien_dewasa->save();
  
            }
            else{
                $no_regis = $request->input("txtIdPasien");
                $pasienid = $request->input("txtIdPasien");
            }

            $new_layanan_kb = new Kb();
            $new_layanan_kb->no_kartu = $nomor;
            $new_layanan_kb->status_peserta = $status_peserta;
            $new_layanan_kb->tgl_status_peserta = $tgl_status_peserta;
            $new_layanan_kb->jumlah_anak_laki = $jumlah_anak_laki;
            $new_layanan_kb->jumlah_anak_perempuan = $jumlah_anak_perempuan;
            $new_layanan_kb->ku = $ku;
            $new_layanan_kb->haid_terakhir = $haid_terakhir;
            $new_layanan_kb->tensi_atas = $tensi_atas;
            $new_layanan_kb->tensi_bawah = $tensi_bawah;
            $new_layanan_kb->bb = $bb;
            $new_layanan_kb->sakit_kuning = $sakit_kuning;
            $new_layanan_kb->perd_per_vag = $perd_per_vag;
            $new_layanan_kb->tumor_payudara = $tumor_payudara;
            $new_layanan_kb->fluoralbus = $fluoralbus;
            $new_layanan_kb->tanda_radang = $tanda_radang;
            $new_layanan_kb->tumor = $tumor;
            $new_layanan_kb->posisi_rahim = $posisi_rahim;
            $new_layanan_kb->genetalia_luar_dalam = $genetalia_luar_dalam;
            $new_layanan_kb->id_jenis_layanan = $id_jenis_layanan;
            $new_layanan_kb->tgl_dilayani = $tgl_dilayani;
            $new_layanan_kb->tgl_datang_kembali = $tgl_datang_kembali;
            $new_layanan_kb->tgl_lepas = $tgl_lepas;
            $new_layanan_kb->no_regis_pasien_dewasa = $no_regis;
            $new_layanan_kb->no_registrasi_pasien = $no_regis;
            $new_layanan_kb->users_id = Auth::user()->id;
            $new_layanan_kb->save();

            // INSERT DB LAMPIRAN
            if ($request->file('lampiran')) {
                foreach ($request->file('lampiran') as $key => $value) {
                    $image = $value;
                    $extensions = $value->getClientOriginalExtension();
                    $filenameToSave = "lampiran_KB_".$no_regis."_".date("Ymd", strtotime($tgl_dilayani))."_".($key+1).".".$extensions;
                    $destinationPath = public_path('/lampiran');
                    $imagePath = "lampiran/". $filenameToSave;
                    $image->move($destinationPath, $filenameToSave);
                    $new_lampiran = new lampiran();
                    $new_lampiran->jenis_layanan = '0';
                    $new_lampiran->id_layanan = $id_jenis_layanan;
                    $new_lampiran->tanggal = $tgl_dilayani;
                    $new_lampiran->url_gambar = $imagePath;
                    $new_lampiran->no_registrasi_pasien = $no_regis;
                    $new_lampiran->save();
                }
            }

            // INSERT DB TRANSAKSI
            $new_transaksi = new Transaksi();
            $new_transaksi->jenis_layanan = '0';
            $new_transaksi->id_layanan = $id_jenis_layanan;
            $new_transaksi->harga_obat = $total_obat;
            $new_transaksi->harga_layanan = $total_layanan;
            $new_transaksi->total_harga = $total_bayar;
            $new_transaksi->tanggal = $tgl_dilayani;
            $new_transaksi->users_id = Auth::user()->id;
            $new_transaksi->save();

            // UPDATE STOK OBAT
            $id_obat = Obat::all();
            if(!empty($id_obat) &&  $id_obat[0]->layanan != null){
                foreach ($id_obat as $key => $value) {
                    $sisa_stok = $value->total_pcs - $value->qty;
                    DB::table('obat')
                    ->where('id', $value->id_obat)
                    ->update(['total_pcs' => $sisa_stok]);
                }
            }

            DB::commit();
            return redirect('/layanan-kb/'.$no_regis)->with(['message'=>'Kartu KB berhasil disimpan.']);

        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect('/layanan-kb/'.$no_regis)->with(['danger_message'=>'History KB gagal disimpan.']);    
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kb  $kb
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $layanankb = DB::select('SELECT * FROM (SELECT lb.id id_kartu, lb.id id_kb, lb.no_kartu, lb.status_peserta, lb.tgl_status_peserta, CONCAT(lb.jumlah_anak_laki, " Anak") jumlah_anak_laki, CONCAT(lb.jumlah_anak_perempuan, " Anak") jumlah_anak_perempuan, lb.ku, lb.haid_terakhir, CONCAT(lb.tensi_atas, "/", lb.tensi_bawah) tensi, lb.bb bb_kb, lb.sakit_kuning, lb.perd_per_vag, lb.tumor_payudara, IF(lb.fluoralbus = "seperti_susu", "seperti susu", lb.fluoralbus) fluoralbus, lb.tanda_radang, lb.tumor, lb.posisi_rahim, lb.genetalia_luar_dalam, lb.id_jenis_layanan jenis_layanan_kb, lb.tgl_dilayani, lb.tgl_datang_kembali, lb.tgl_lepas, l.nama nama_layanan, lb.no_registrasi_pasien, l.tarif_layanan, format(l.tarif_layanan,"id-ID") str_tarif_layanan FROM layanan_kb lb LEFT JOIN layanan l ON lb.id_jenis_layanan = l.id) ly LEFT JOIN pasien_dewasa p ON ly.no_registrasi_pasien = p.no_registrasi WHERE p.status_hapus <> 1 AND p.no_registrasi = "'.$id.'"');
        // $layanankbArr = json_decode(json_encode($layanankb), true);
        $layanankbArr = Kb::where('no_regis_pasien_dewasa',$id)->get();
        // dd()

        // $history_kb = DB::select('SELECT h.*, l.nama FROM history_kb h LEFT JOIN layanan l ON h.id_jenis_layanan = l.id WHERE h.id_layanan_kb = '.$layanankbArr[0]['id_kb'].' order by h.tgl DESC');
        $history_kb = HistoryKB::where('id_layanan_kb',$layanankbArr[0]->id)->get();
        // dd($history_kb);
        $nama_layanan = "";
        if(count($history_kb) > 0){
            $last_index = count($history_kb) - 1;
            $nama_layanan = $history_kb[$last_index]->nama;
        }
        else{
            $nama_layanan = $layanankbArr[0]['nama_layanan'];
        }

        //get access all controller
        // $controller = $this;
        // dd($layanankbArr[0]->pasienDewasa);
        
        // get all informed consent
        // $informed_consent = DB::select('SELECT l.url_gambar FROM lampiran l WHERE id_layanan = '.$layanankbArr[0]->jenis_layanan_kb.' AND no_registrasi_pasien = "'.$layanankbArr[0]->no_registrasi.'"');
        $informed_consent = lampiran::where('id_layanan',$layanankbArr[0]->jenis_layanan_kb)->get();
        return view('layanan.KB.history', compact(['layanankbArr', 'informed_consent', 'nama_layanan', 'history_kb']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kb  $kb
     * @return \Illuminate\Http\Response
     */
    public function edit(Kb $kb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kb  $kb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kb $kb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kb  $kb
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kb $kb)
    {
        //
    }

    public function getHargaLayanan(Request $request)
    {
        $idlayanan = $request->input('layanan_id');
        // dd($idlayanan);

        $layanan = DB::select('SELECT format(l.tarif_total,"id-ID") str_tarif_total, format(l.tarif_layanan,"id-ID") str_tarif_layanan, ob.nama, format(ob.subtotal,"id-ID") str_subtotal, l.tarif_total, l.tarif_layanan, ob.subtotal, ob.qty, ob.id id_obat
            FROM layanan l LEFT JOIN (SELECT o.nama, o.kode_obat, ol.subtotal, ol.id_layanan, ol.qty, o.id FROM obat o LEFT JOIN obat_layanan ol ON o.id = ol.id_obat WHERE o.status_hapus <> 1) ob ON l.id = ob.id_layanan
            WHERE l.status_hapus <> 1 AND l.id = '.$idlayanan);

        if(count($layanan) > 0){
            echo json_encode($layanan);
        }
        else{
            echo "";
        }
    }

    public function cekStokObat(Request $request)
    {
        $id_layanan = $request->input('id_layanan');
        $listidobat = $request->input('obat_id');
        $arrIdObat = explode(";", $listidobat);
        array_pop($arrIdObat); //remove last id

        if(!empty($arrIdObat) && $arrIdObat[0] != ""){
            $var_con = 0;
            foreach ($arrIdObat as $key => $value) {
                $obat = DB::select('SELECT o.total_pcs, ol.qty FROM obat o LEFT JOIN obat_layanan ol ON o.id = ol.id_obat WHERE o.id = '.$value.' AND ol.id_layanan = '.$id_layanan.' GROUP BY o.id, o.total_pcs, ol.qty');
                
                if(count($obat) > 0){
                    if(($obat[0]->total_pcs - $obat[0]->qty) >= 0){
                        $var_con++;
                    }
                }
            }
            
            if(count($arrIdObat) == $var_con){
                echo "true";
            }
            else{
                echo "false";
            }
        }
        else{
            echo "true";
        }
    }

    public function cekStokObat2(Request $request)
    {
        $arrListIdObat = $request->input("txtIdObat");
        $arrQtyObat = $request->input("txtQtyObat");

        if(!empty($arrListIdObat) && $arrListIdObat!= []){
            $var_con = 0;
            foreach ($arrListIdObat as $key => $value) {
                $obat = DB::select('SELECT o.total_pcs, ol.qty FROM obat o LEFT JOIN obat_layanan ol ON o.id = ol.id_obat WHERE o.id = '.$value.' GROUP BY o.id, o.total_pcs, ol.qty');

                if(count($obat) > 0){
                    if(($obat[0]->total_pcs - $arrQtyObat[$key]) >= 0){
                        $var_con++;
                    }                    
                }
            }
            
            if(count($arrListIdObat) == $var_con){
                echo "true";
            }
            else{
                echo "false";
            }
        }
        else{
            echo "true";
        }
    }

    public function buatKartu($id)
    {
        $pasienArr = PasienDewasa::where('no_regis',$id)->where('status_hapus',0)->get();
        $layanan = JenisLayanan::where('status_hapus',0)->where('pelayanan',0)->get();
        return view('layanan.Kb.buat_kartu', compact(['pasienArr', 'layanan']));
    }

    public function buatKartuStore(Request $request)
    {
        // $pasienArr = PasienDewasa::where('no_regis',$id)->where('status_hapus',0)->get();
        // $layanan = JenisLayanan::where('status_hapus',0)->where('pelayanan',0)->get();
        // return view('layanan.Kb.buat_kartu', compact(['pasienArr', 'layanan']));
    }

    public function indexTambahHistoryKb($id)
    {
        $layanankbArr = Kb::where('id',$id)->get();
        // dd($layanankbArr);
        // $layanankbArr[0]['tarif_layanan']
        $history_kb = HistoryKB::where('id_layanan_kb',$id)->get();
        $nama_layanan = "";
        if(count($history_kb) > 0){
            $last_index = count($history_kb) - 1;
            $nama_layanan = $history_kb[$last_index]->nama;
            $id_layanan = $history_kb[$last_index]->id_jenis_layanan;
        }
        else{
            $nama_layanan = $layanankbArr[0]['nama_layanan'];
            $id_layanan = $layanankbArr[0]['id_kb'];
        }
        $layanan = JenisLayanan::where('status_hapus', '<>' ,'1')->where('pelayanan',0)->get();
        $obat = Obat::where('status_hapus','<>' ,'1')->where('total_pcs','>','0')->get();
        return view('layanan.KB.historyTambah', compact(['id_layanan', 'layanankbArr', 'layanan', 'obat', 'nama_layanan']));
    }

    public function kbInsertTambahHistory(Request $request)
    {
        // INITIAL REQUEST
        $id_kartu = $request->input("txtIdKartu");
        $id_pasien = $request->input("txtIdPasien");
        $tgl = date("Y-m-d", strtotime($request->input("txtTanggal")));
        $tgl_haid = date("Y-m-d", strtotime($request->input("txtTanggalHaid")));
        $bb = str_replace(",", ".", $request->input("txtBB"));
        $tek_atas = $request->input("txtTekDarahAtas");
        $tek_bawah = $request->input("txtTekDarahBawah");
        $keluhan_efek_samping = $request->input("txtEfekSampingKeluhan");
        $komplikasi = $request->input("txtKomplikasi");
        $tindakan = $request->input("txtTindakan");
        $efeksamping = $request->input("txtEfekSamping");
        $list_id_obat = $request->input("txtIdObat");
        $qty_obat = $request->input("txtQtyObat");
        $grandtotalobattambah = is_null($request->input("txtGrandtotalObatTambah")) ? 0 : $request->input("txtGrandtotalObatTambah");
        $totalObat = is_null($request->input("txtTotalObat")) ? 0 : $request->input("txtTotalObat");
        $tarif_layanan = $request->input("txtTarifLayanan");
        $tarif_total = $request->input("txtTarifTotal");

        // $noreg = DB::select('SELECT no_registrasi FROM pasien_dewasa WHERE id = "'.$id_pasien.'"');
        // print_r($list_id_obat." - qty : ".$qty_obat);
        // die();
        DB::beginTransaction();
        try {
            $arrListIdObat = explode(",", $list_id_obat);
            $arrQtyObat = explode(",", $qty_obat);

            if($request->input("detectChangeKB") == "0"){
                $id_layanan = $request->input("txtIdLayanan");
            }
            else{
                $id_layanan = $request->input("cboJenisKB");
            }

            
            // INSERT KB HISTORY
            $new_history_kb = new HistoryKB();
            $new_history_kb->id_layanan_kb = $id_kartu;
            $new_history_kb->id_jenis_layanan = $request->txtIdLayanan;
            $new_history_kb->tgl = $tgl;
            $new_history_kb->tgl_haid = $tgl_haid;
            $new_history_kb->bb = $bb;
            $new_history_kb->tensi_atas = $tek_atas;
            $new_history_kb->tensi_bawah = $tek_bawah;
            $new_history_kb->keluhan_efek_samping = $keluhan_efek_samping;
            $new_history_kb->komplikasi = $komplikasi;
            $new_history_kb->tindakan = $tindakan;
            $new_history_kb->tindakan_efek_samping = $efeksamping;
            $new_history_kb->id_jenis_layanan = $id_layanan;
            $new_history_kb->save();
         

            // INSERT DB TRANSAKSI
            $hargatotalobat = $totalObat + $grandtotalobattambah;
            
            $new_transaksi = new Transaksi();
            $new_transaksi->jenis_layanan = '0';
            $new_transaksi->id_layanan = $id_layanan;
            $new_transaksi->harga_obat = $hargatotalobat;
            $new_transaksi->harga_layanan = $tarif_layanan;
            $new_transaksi->total_harga = $tarif_total;
            $new_transaksi->tanggal = $tgl;
            $new_transaksi->users_id = Auth::user()->id;
            $new_transaksi->save();
         
            if(($request->input("detectUseObat") == "1" || $request->input("detectChangeKB") == "1") && !empty($arrListIdObat) && $arrListIdObat[0] != ""){
                $history_kb = HistoryKB::where('id_layanan_kb',$id_kartu)->first();
                foreach ($arrListIdObat as $key => $value) {
                    $obat = Obat::find($value);
                    $harga =$obat->harga;
                    $obat->kb()->attach($history_kb->id,['qty' => (int)$arrQtyObat[$key],'harga_obat' => $harga,'total_harga_obat' => (int)$harga * (int)$arrQtyObat[$key]]);
                 
                    // UPDATE OBAT (YANG ADA DI TABLE)
                    $sisa_stok = $obat->total_pcs - (int)$arrQtyObat[$key];
                    $obat->total_pcs = $sisa_stok;
                    $obat->save();             
                }
            }

            DB::commit();
            return redirect('/layanan-kb/'.$id_pasien)->with(['message'=>'History KB berhasil disimpan.']);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect('/layanan-kb/'.$id_pasien)->with(['danger_message'=>'History KB gagal disimpan.']);    
        }
        
    }

}
