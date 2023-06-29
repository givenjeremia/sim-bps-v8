<?php

namespace App\Http\Controllers\layanan;

use App\Models\lampiran;
use App\Models\HeaderKspr;
use App\Models\HistoryIbuHamilObat;
use App\Models\HistoryKspr;
use App\Models\HistoryLayananIbuHamil;
use Illuminate\Http\Request;
use App\Models\layanan\IbuHamil;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\master\JenisLayanan;
use App\Models\master\PasienDewasa;
use Illuminate\Support\Facades\Auth;
use App\Models\layanan\RiwayatKehamilan;
use App\Models\master\Obat;
use App\Models\master\SuamiPasienDewasa;
use App\Models\MasterKspr;
use App\Models\Transaksi;

class IbuHamilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasien = PasienDewasa::where('status_hapus', 0)->get();
        return view('layanan.ibu_hamil.index', compact(['pasien']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $noreg = PasienDewasa::generateNoRegister();
        $layanan = DB::select('SELECT format(l.tarif_total,"id-ID") str_tarif_total, format(l.tarif_layanan,"id-ID") str_tarif_layanan, ob.nama, format(ob.subtotal,"id-ID") str_subtotal, l.tarif_total, l.tarif_layanan, ob.subtotal, ob.qty, ob.id id_obat, l.id id_layanan 
            FROM layanan l LEFT JOIN (SELECT o.nama, o.kode_obat, ol.subtotal, ol.id_layanan, ol.qty, o.id FROM obat o LEFT JOIN obat_layanan ol ON o.id = ol.id_obat WHERE o.status_hapus <> 1) ob ON l.id = ob.id_layanan
            WHERE l.status_hapus <> 1 AND l.pelayanan = 3');
        $kspr_table = MasterKspr::where('status_hapus', 0)->get();
        return view('layanan.ibu_hamil.tambah', compact(['noreg', 'layanan', 'kspr_table']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Get Login ID
        $user = Auth::user();
        // Get Data
        $txtNoregis = $request->input("txtNoregis");
        $txtNamaibu = $request->input("txtNamaibu");
        $txtTanggalLahiribu = $request->input("txtTanggalLahiribu");
        $txtAgamaibu = $request->input("txtAgamaibu");
        $txtAlamatibu = $request->input("txtAlamatibu");
        $txtPhoneibu = $request->input("txtPhoneibu");
        $txtKelurahanibu = $request->input("txtKelurahanibu");
        $txtPekerjaanibu = $request->input("txtPekerjaanibu");
        $txtPendidikanibu = $request->input("txtPendidikanibu");
        $cboBukuKIA = $request->input("cboBukuKIA");
        $tglKIA = $request->input("tglKIA");
        $txtNamaayah = $request->input("txtNamaayah");
        $txtTanggalLahirayah = $request->input("txtTanggalLahirayah");
        $txtAgamaayah = $request->input("txtAgamaayah");
        $txtAlamatayah = $request->input("txtAlamatayah");
        $txtPhoneayah = $request->input("txtPhoneayah");
        $txtKelurahanayah = $request->input("txtKelurahanayah");
        $txtPekerjaanayah = $request->input("txtPekerjaanayah");
        $txtPendidikanayah = $request->input("txtPendidikanayah");
        $txtKawinke = $request->input("txtKawinke");
        $txtLamaKawin = $request->input("txtLamaKawin");
        $txtLamaKawinBulan = $request->input("txtLamaKawinBulan");
        $cboSebabPisah = $request->input("cboSebabPisah");
        $txtSebabmeninggal = $request->input("txtSebabmeninggal");
        $riwayat_kawin = $request->input("riwayat_kawin");
        $rdoHamilPertama = $request->input("rdoHamilPertama");
        $txthamilke = $request->input("txthamilke");
        $txtKehamilanKe = $request->input("txtKehamilanKe");
        $txtBerat = $request->input("txtBerat");
        $txtKetKeadaanAnak = $request->input("txtKetKeadaanAnak");
        $txtKB = $request->input("txtKB");
        $txtAsi = $request->input("txtAsi");
        $txtG = $request->input("txtG");
        $txtHaid = $request->input("txtHaid");
        $txtHpht = $request->input("txtHpht");
        $txtHpl = $request->input("txtHpl");
        $txtBBsblmHamil = str_replace(",", ".", $request->input("txtBBsblmHamil"));
        $txtSelectMual = $request->input("txtSelectMual");
        $txtmual = $request->input("txtmual");
        $txtPusing = $request->input("txtPusing");
        $txtKeteranganPusing = $request->input("txtKeteranganPusing");
        $txtNyeriPerut = $request->input("txtNyeriPerut");
        $txtKeteranganNyeriPerut = $request->input("txtKeteranganNyeriPerut");
        $txtGerakJanin = $request->input("txtGerakJanin");
        $txtketerangangerakJanin = $request->input("txtketerangangerakJanin");
        $txtOedema = $request->input("txtOedema");
        $txtKeteranganOedema = $request->input("txtKeteranganOedema");
        $txtNafsuMakan = $request->input("txtNafsuMakan");
        $txtKeteranganNafsuMakan = $request->input("txtKeteranganNafsuMakan");
        $txtPendarahan = $request->input("txtPendarahan");
        $txtPendarahansejak = $request->input("txtPendarahansejak");
        $txt_keluhan_utama = $request->input("txt_keluhan_utama");
        $txtHasilKSPR = $request->input("txtHasilKSPR");
        $txtDOTK = $request->input("txtDOTK");
        $txtDOM = $request->input("txtDOM");
        $txt_rujuk_ke = $request->input("txt_rujuk_ke");
        $txt_penyakit_yang_diderita = $request->input("txt_penyakit_yang_diderita");
        $txt_riwayat_penyakit_keluarga = $request->input("txt_riwayat_penyakit_keluarga");
        $txt_kebiasaan_ibu = $request->input("txt_kebiasaan_ibu");
        $txtStatusTT = $request->input("txtStatusTT");
        $tanggal_imunisasi = $request->input("tanggal_imunisasi");
        $txtResikoHIV = $request->input("txtResikoHIV");
        $txt_penyebab_hiv = $request->input("txt_penyebab_hiv");
        $txtTB = $request->input("txtTB");
        $txtLILA = $request->input("txtLILA");
        $txtIMT = $request->input("txtIMT");
        $txtBentukTubuh = $request->input("txtBentukTubuh");
        $txtKetBentukTubuh = $request->input("txtKetBentukTubuh");
        $txtKesadaran = $request->input("txtKesadaran");
        $txtketKesadaran = $request->input("txtketKesadaran");
        $txtMuka = $request->input("txtMuka");
        $txtketMuka = $request->input("txtketMuka");
        $txtKulit = $request->input("txtKulit");
        $txtketKulit = $request->input("txtketKulit");
        $txtMata = $request->input("txtMata");
        $txtketMata = $request->input("txtketMata");
        $txtMulut = $request->input("txtMulut");
        $txtketMulut = $request->input("txtketMulut");
        $txtGigi = $request->input("txtGigi");
        $txtketGigi = $request->input("txtketGigi");
        $txtPemKel = $request->input("txtPemKel");
        $txtketPemKel = $request->input("txtketPemKel");
        $txtDada = $request->input("txtDada");
        $txtketDada = $request->input("txtketDada");
        $txtParu = $request->input("txtParu");
        $txtketParu = $request->input("txtketParu");
        $txtJantung = $request->input("txtJantung");
        $txtketJantung = $request->input("txtketJantung");
        $txtPayudara = $request->input("txtPayudara");
        $txtketPayudara = $request->input("txtketPayudara");
        $txtTangan = $request->input("txtTangan");
        $txtRefleks = $request->input("txtRefleks");
        $txtGolIbu = $request->input("txtGolIbu");
        $txtGolAyah = $request->input("txtGolAyah");
        $txtPenolongPersalinan = $request->input("txtPenolongPersalinan");
        $txtTempat = $request->input("txtTempat");
        $txtPendamping = $request->input("txtPendamping");
        $txtCalonDonor = $request->input("txtCalonDonor");
        $txtSticker = $request->input("txtSticker");
        $txtTglPasang = $request->input("txtTglPasang");
        $txtKesimpulanDiagnosa = $request->input("txtKesimpulanDiagnosa");
        $riwayat_hamil = $request->input("riwayat_hamil");
        $lampiran = $request->file("lampiran");
        $id_jenis_layanan = $request->input("id_layanan");
        $harga_layanan = $request->input('harga_layanan');
        $harga_total = $request->input('harga_total');
        $list_obat = $request->input('list_obat');
        $list_qty = $request->input('list_qty');
        $harga_obat = $request->input('harga_obat');
        $list_kspr = $request->input('cboOpsi');
        $grandtotalkspr = $request->input('grandtotalkspr');
        $rdoRujukan = $request->input('rdoRujukan');

        $tgl_buku_kia = NULL;
        if ($cboBukuKIA == "punya") {
            $tgl_buku_kia = date("Y-m-d", strtotime($tglKIA));
        }

        DB::beginTransaction();
        try {
            // INSERT DATA IBU & SUAMI
            $new_pasien_dewasa =  new PasienDewasa();
            $new_pasien_dewasa->no_regis = $txtNoregis;
            $new_pasien_dewasa->nama = $txtNamaibu;
            $new_pasien_dewasa->tanggal_lahir = date("Y-m-d", strtotime($txtTanggalLahiribu));
            $new_pasien_dewasa->agama = $txtAgamaibu;
            $new_pasien_dewasa->alamat = $txtAlamatibu;
            $new_pasien_dewasa->telp = $txtPhoneibu;
            $new_pasien_dewasa->kelurahan = $txtKelurahanibu;
            $new_pasien_dewasa->pekerjaan = $txtPekerjaanibu;
            $new_pasien_dewasa->pendidikan = $txtPendidikanibu;
            $new_pasien_dewasa->buku_kia = $cboBukuKIA;
            $new_pasien_dewasa->tgl_buku_kia = $tgl_buku_kia;
            $new_pasien_dewasa->status_hapus = 0;
            $new_pasien_dewasa->save();
            // Add Suami
            $arr_riwayat_kawin = $riwayat_kawin;
            foreach ($arr_riwayat_kawin as $key => $value) {
                $arrValue = explode(";", $value);
                $new_suami = new SuamiPasienDewasa();
                $new_suami->nama = $txtNamaayah;
                $new_suami->tanggal_lahir = date("Y-m-d", strtotime($txtTanggalLahirayah));
                $new_suami->agama = $txtAgamaayah;
                $new_suami->alamat = $txtAlamatayah;
                $new_suami->telp = $txtPhoneayah;
                $new_suami->kelurahan = $txtKelurahanayah;
                $new_suami->pekerjaan = $txtPekerjaanayah;
                $new_suami->pendidikan = $txtPendidikanayah;
                $new_suami->nikah_ke = $arrValue[0];
                $new_suami->lama_nikah = $arrValue[1];
                $new_suami->sebab_pisah = $arrValue[2];
                $new_suami->sebab_meninggal = $arrValue[3];
                $new_suami->no_regis_pasien_dewasa  = $new_pasien_dewasa->no_regis;
                $new_suami->save();
            }

            // INSERT LAYANAN IBU HAMIL
            if (preg_match('/\bmerah\b/', $rdoRujukan)) {
                $savestring = "red;" . $rdoRujukan;
            } elseif (preg_match('/\bkuning\b/', $rdoRujukan)) {
                $savestring = "yellow;" . $rdoRujukan;
            } else {
                $savestring = "#47d147;" . $rdoRujukan;
            }
            $new_ibu_hamil = new IbuHamil();
            $new_ibu_hamil->users_id = $user->id;
            $new_ibu_hamil->no_regis_pasien_dewasa = $txtNoregis;
            $new_ibu_hamil->tanggal = date("Y-m-d");
            $new_ibu_hamil->rujukan_terencana = $savestring;
            $new_ibu_hamil->g = $txtG;
            $new_ibu_hamil->haid = $txtHaid;
            $new_ibu_hamil->hpht = date("Y-m-d", strtotime($txtHpht));
            $new_ibu_hamil->hpl = date("Y-m-d", strtotime($txtHpl));
            $new_ibu_hamil->bb_sebelum_hamil = str_replace(",", ".", $txtBBsblmHamil);
            $new_ibu_hamil->mual_muntah = $txtSelectMual;
            $new_ibu_hamil->ket_mual_muntah = $txtmual;
            $new_ibu_hamil->pusing = $txtPusing;
            $new_ibu_hamil->ket_pusing = $txtKeteranganPusing;
            $new_ibu_hamil->nyeri_perut = $txtNyeriPerut;
            $new_ibu_hamil->ket_nyeri_perut = $txtKeteranganNyeriPerut;
            $new_ibu_hamil->gerak_janin = $txtGerakJanin;
            $new_ibu_hamil->ket_gerak_janin = $txtketerangangerakJanin;
            $new_ibu_hamil->oedema = $txtOedema;
            $new_ibu_hamil->ket_oedema = $txtKeteranganOedema;
            $new_ibu_hamil->nafsu_makan = $txtNafsuMakan;
            $new_ibu_hamil->ket_nafsu_makan = $txtKeteranganNafsuMakan;
            $new_ibu_hamil->pendarahan = $txtPendarahan;
            $new_ibu_hamil->pendarahan_sejak = $txtPendarahansejak;
            $new_ibu_hamil->keluhan_utama = $txt_keluhan_utama;
            $new_ibu_hamil->hasil_skor_kspr = $txtHasilKSPR;
            $new_ibu_hamil->dotk = $txtDOTK;
            $new_ibu_hamil->dom = $txtDOM;
            $new_ibu_hamil->rujuk_ke = $txt_rujuk_ke;
            $new_ibu_hamil->penyakit_yang_diderita = $txt_penyakit_yang_diderita;
            $new_ibu_hamil->riwayat_penyakit_keluarga = $txt_riwayat_penyakit_keluarga;
            $new_ibu_hamil->kebiasaan_ibu = $txt_kebiasaan_ibu;
            $new_ibu_hamil->statustt = $txtStatusTT;
            $new_ibu_hamil->tanggal_imunisasi = date("Y-m-d", strtotime($tanggal_imunisasi));
            $new_ibu_hamil->resiko_hiv = $txtResikoHIV;
            $new_ibu_hamil->penyebab_hiv = $txt_penyebab_hiv;
            $new_ibu_hamil->tb = $txtTB;
            $new_ibu_hamil->lila = $txtLILA;
            $new_ibu_hamil->imt = $txtIMT;
            $new_ibu_hamil->bentuk_tubuh = $txtBentukTubuh;
            $new_ibu_hamil->ket_bentuk_tubuh = $txtKetBentukTubuh;
            $new_ibu_hamil->kesadaran = $txtKesadaran;
            $new_ibu_hamil->ket_kesadaran = $txtketKesadaran;
            $new_ibu_hamil->muka = $txtMuka;
            $new_ibu_hamil->ket_muka = $txtketMuka;
            $new_ibu_hamil->kulit = $txtKulit;
            $new_ibu_hamil->ket_kulit = $txtketKulit;
            $new_ibu_hamil->mata = $txtMata;
            $new_ibu_hamil->ket_mata = $txtketMata;
            $new_ibu_hamil->mulut = $txtMulut;
            $new_ibu_hamil->ket_mulut = $txtketMulut;
            $new_ibu_hamil->gigi = $txtGigi;
            $new_ibu_hamil->ket_gigi = $txtketGigi;
            $new_ibu_hamil->pembesaran_kel = $txtPemKel;
            $new_ibu_hamil->ket_pembesaran_kel = $txtketPemKel;
            $new_ibu_hamil->dada = $txtDada;
            $new_ibu_hamil->ket_dada = $txtketDada;
            $new_ibu_hamil->paru = $txtParu;
            $new_ibu_hamil->ket_paru = $txtketParu;
            $new_ibu_hamil->jantung = $txtJantung;
            $new_ibu_hamil->ket_jantung = $txtketJantung;
            $new_ibu_hamil->payudara = $txtPayudara;
            $new_ibu_hamil->ket_payudara = $txtketPayudara;
            $new_ibu_hamil->tangan_tungkai = $txtTangan;
            $new_ibu_hamil->refleks = $txtRefleks;
            $new_ibu_hamil->golongan_darah_ibu = $txtGolIbu;
            $new_ibu_hamil->golongan_darah_suami = $txtGolAyah;
            $new_ibu_hamil->penolong = $txtPenolongPersalinan;
            $new_ibu_hamil->tempat = $txtTempat;
            $new_ibu_hamil->pendamping = $txtPendamping;
            $new_ibu_hamil->calon_donor = $txtCalonDonor;
            $new_ibu_hamil->stiker_p4k = $txtSticker;
            $new_ibu_hamil->dipasang_tanggal = $txtTglPasang;
            $new_ibu_hamil->kesimpulan_diagnosa = $txtKesimpulanDiagnosa;
            $new_ibu_hamil->status_hapus = 0;
            $new_ibu_hamil->save();
            $id_new_ibu_hamil = $new_ibu_hamil->id;

            // INSERT RIWAYAT KEHAMILAN
            if ($rdoHamilPertama != "ya") {
                $arr_riwayat_hamil = explode(";", $riwayat_hamil);
                foreach ($arr_riwayat_hamil as $key_hamil => $value_hamil) {
                    $arrValue = explode("~", $value_hamil);
                    array_pop($arrValue);
                    $new_riwayat = new RiwayatKehamilan();
                    $new_riwayat->id_layanan_ibu_hamil = $id_new_ibu_hamil;
                    $new_riwayat->kehamilan_ke = $arrValue[0];
                    $new_riwayat->komplikasi = $arrValue[1];
                    $new_riwayat->persalinan = $arrValue[2];
                    $new_riwayat->tempat_persalinan = $arrValue[3];
                    $new_riwayat->komplikasi_persalinan = $arrValue[4];
                    $new_riwayat->penolong = $arrValue[5];
                    $new_riwayat->keadaan_bbl_kelamin = $arrValue[6];
                    $new_riwayat->keadaan_bbl_berat = str_replace(",", ".", $arrValue[7]);
                    $new_riwayat->keadaan_bbl = $arrValue[8];
                    $new_riwayat->keadaan_anak_sekarang = $arrValue[9];
                    $new_riwayat->ket_keadaan_anak_sekarang = $arrValue[10];
                    $new_riwayat->kb = $arrValue[11];
                    $new_riwayat->asi = $arrValue[12];
                    $new_riwayat->status_hapus = 0;
                    $new_riwayat->save();
                }
            } else {
                $new_riwayat = new RiwayatKehamilan();
                $new_riwayat->id_layanan_ibu_hamil = $id_new_ibu_hamil;
                $new_riwayat->kehamilan_ke = 1;
                $new_riwayat->komplikasi = '';
                $new_riwayat->persalinan = '';
                $new_riwayat->tempat_persalinan = '';
                $new_riwayat->komplikasi_persalinan = '';
                $new_riwayat->penolong = '';
                $new_riwayat->keadaan_bbl_kelamin = '';
                $new_riwayat->keadaan_bbl_berat = 0;
                $new_riwayat->keadaan_bbl = '';
                $new_riwayat->keadaan_anak_sekarang = '';
                $new_riwayat->ket_keadaan_anak_sekarang = '';
                $new_riwayat->kb = '';
                $new_riwayat->asi = '';
                $new_riwayat->status_hapus = 0;
                $new_riwayat->save();
            }

            // INSERT DB LAMPIRAN
            if ($lampiran) {
                foreach ($lampiran as $key => $value) {
                    $image = $value;
                    $extensions = $value->getClientOriginalExtension();
                    $filenameToSave = "lampiran_IH_" . $txtNoregis . "_" . date("Ymd") . "_" . ($key + 1) . "." . $extensions;
                    $destinationPath = public_path('/lampiran');
                    $imagePath = "lampiran/" . $filenameToSave;
                    $image->move($destinationPath, $filenameToSave);;
                    $new_lampiran = new lampiran();
                    $new_lampiran->jenis_layanan = 3;
                    // $new_lampiran->id_layanan = $id_new_ibu_hamil;
                    $new_lampiran->url_gambar = $imagePath;
                    $new_lampiran->no_registrasi_pasien = $txtNoregis;
                    $new_lampiran->tanggal = date("Y-m-d");
                    $new_lampiran->save();
                }
            }

            // INSERT KSPR
            $count_kspr = HeaderKspr::where('id_layanan_ibu_hamil', $id_new_ibu_hamil)->count();
            $new_header_kspr = new HeaderKspr();
            $new_header_kspr->judul = 'Triwulan ' . ($count_kspr + 1);
            $new_header_kspr->total_skor = $grandtotalkspr;
            $new_header_kspr->id_layanan_ibu_hamil = $id_new_ibu_hamil;
            $new_header_kspr->save();
            $id_new_header_kspr  = $new_header_kspr->id;

            $master_kspr = MasterKspr::where('status_hapus', 0)->get();

            foreach ($master_kspr as $key => $value) {
                if ($value->urutan == 0) {
                    $skorkspr = 2;
                } else {
                    $skorkspr = $list_kspr[$key - 1];
                }
                $new_history_kspr =  new HistoryKspr();
                $new_history_kspr->skor = $skorkspr;
                $new_history_kspr->id_header_kspr = $id_new_header_kspr;
                $new_history_kspr->id_master_kspr = $value->id;
                $new_history_kspr->save();
            }

            // INSERT TRANSAKSI
            $new_transaksi = new Transaksi();
            $new_transaksi->users_id = $user->id;
            $new_transaksi->jenis_layanan = '3';
            $new_transaksi->id_layanan = $id_jenis_layanan;
            $new_transaksi->harga_obat = $harga_obat;
            $new_transaksi->harga_layanan = $harga_layanan;
            $new_transaksi->total_harga = $harga_total;
            $new_transaksi->tanggal = date("Y-m-d");
            $new_transaksi->save();

            // INSERT OBAT 
            $new_history_layanan_ibu_hamil = new HistoryLayananIbuHamil();
            $new_history_layanan_ibu_hamil->id_layanan_ibu_hamil = $id_new_ibu_hamil;
            // $new_history_layanan_ibu_hamil->tanggal = date("Y-m-d");
            $new_history_layanan_ibu_hamil->keluhan = "Kedatangan Pertama";
            $new_history_layanan_ibu_hamil->save();
            $id_history_layanan_ibu_hamil = $new_history_layanan_ibu_hamil->id;

            $arrListObat = explode(";", $list_obat);
            $arrListQty = explode(";", $list_qty);
            array_pop($arrListObat);
            array_pop($arrListQty);

            if (!empty($arrListObat) && $arrListObat[0] != "") {
                foreach ($arrListObat as $key => $value) {
                    $new_hist_ibu_hamil_obat = new HistoryIbuHamilObat();
                    $new_hist_ibu_hamil_obat->id_history_ibu_hamil = $id_history_layanan_ibu_hamil;
                    $new_hist_ibu_hamil_obat->id_obat = $value;
                    $new_hist_ibu_hamil_obat->qty = $arrListQty[$key];
                    $new_hist_ibu_hamil_obat->save();
                    // UPDATE STOK OBAT
                    $obat_list = Obat::find($value);
                    $sisa_stok = $obat_list->total_pcs - (int)$arrListQty[$key];
                    $obat_list->total_pcs = $sisa_stok;
                    $obat_list->save();
                }
            }

            DB::commit();
            // all good
            return redirect('/layanan-ibu-hamil/' . $txtNoregis)->with(['message' => 'Data Kehamilan berhasil disimpan.']);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect('/layanan-ibu-hamil/' . $txtNoregis)->with(['danger_message' => 'Data kehamilan gagal disimpan.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function show($ibuHamil)
    {
        //
        $pasien = PasienDewasa::where('no_regis', $ibuHamil)->get();

        $hklinik = DB::select('SELECT lih.*, rk.kehamilan_ke, rk.id id_layanan
            FROM riwayat_kehamilan rk 
            RIGHT JOIN layanan_ibu_hamil lih
            ON lih.id = rk.id_layanan_ibu_hamil
            WHERE lih.no_regis_pasien_dewasa=?', [$ibuHamil]);

        return view('layanan.ibu_hamil.detail', compact(['pasien', 'hklinik']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function edit(IbuHamil $ibuHamil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IbuHamil $ibuHamil)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IbuHamil  $ibuHamil
     * @return \Illuminate\Http\Response
     */
    public function destroy(IbuHamil $ibuHamil)
    {
        //
    }

    public function ibu_hamil_cek_stok_obat(Request $request)
    {
        $id_layanan = $request->input('id_layanan');
        $listidobat = $request->input('obat_id');
        $arrIdObat = explode(";", $listidobat);
        array_pop($arrIdObat); //remove last id

        if (!empty($arrIdObat) && $arrIdObat[0] != "") {
            $var_con = 0;
            foreach ($arrIdObat as $key => $value) {
                $obat = DB::select('SELECT o.total_pcs, ol.qty FROM obat o LEFT JOIN obat_layanan ol ON o.id = ol.id_obat WHERE o.id = ' . $value . ' AND ol.id_layanan = ' . $id_layanan . ' GROUP BY o.id, o.total_pcs, ol.qty');

                if (count($obat) > 0) {
                    if (($obat[0]->total_pcs - $obat[0]->qty) >= 0) {
                        $var_con++;
                    }
                }
            }

            if (count($arrIdObat) == $var_con) {
                echo "true";
            } else {
                echo "false";
            }
        } else {
            echo "true";
        }
    }

    public function detailLayanan(Request $request, $id)
    {
        $layanan = IbuHamil::where('id', $id)->get();
        $hlayanan = HistoryLayananIbuHamil::where('id_layanan_ibu_hamil', $id)->get();
        $c_persalinan = DB::table('catatan_persalinan')->where('id_layanan_ibu_hamil', $id)->count();
        $informed_consent = DB::select('SELECT l.url_gambar FROM lampiran l WHERE id_layanan = ' . $id . ' AND no_registrasi_pasien = "' . $layanan[0]->no_registrasi . '"');
        return view('layanan.ibu_hamil.detail_layanan', compact(['hlayanan', 'layanan', 'c_persalinan', 'informed_consent']));
    }

    public function get_riwayat_hamil(Request $request)
    {
        $id = $request->no_registrasi;
        $riwayat_hamil = DB::select("SELECT rk.`kehamilan_ke`, lih.`no_regis_pasien_dewasa`, lih.*, rk.* FROM `layanan_ibu_hamil` lih
            INNER JOIN `riwayat_kehamilan` rk
            ON rk.`id_layanan_ibu_hamil`=lih.`id`
            WHERE lih.no_regis_pasien_dewasa=?
            ORDER BY rk.`kehamilan_ke` DESC", [$id]);
        //$riwayat_hamil = json_decode(json_encode($riwayat_hamil), true);
        $sekarang = isset($riwayat_hamil[0]->kehamilan_ke) ? $riwayat_hamil[0]->kehamilan_ke : 0;
        //$sekarang =1;
        return $sekarang;
    }

    public function detailTambah($id)
    {
        if (substr($id, 0, 2) == 'PD') {
            $pasien = DB::select("SELECT 
                pd.no_regis AS id_ibu, pd.nama AS nama_ibu, pd.no_regis AS no_reg_ibu, pd.tanggal_lahir AS tl_ibu,
                pd.agama AS agama_ibu, pd.alamat AS alamat_ibu, pd.telp AS telp_ibu, pd.kelurahan AS kelurahan_ibu,
                pd.pekerjaan AS pekerjaan_ibu, pd.pendidikan AS pendidikan_ibu,
                pd.buku_kia AS buku_kia_ibu, pd.tgl_buku_kia AS tgl_buku_kia_ibu, pd.status_hapus AS status_hapus_ibu,
                pd.created_at AS created_at_ibu, pd.updated_at AS update_at_ibu,

                spd.id AS id_suami, spd.nama AS nama_suami, spd.tanggal_lahir AS tanggal_lahir_suami, spd.agama AS agama_suami, 
                spd.alamat AS alamat_suami, spd.telp AS telp_suami, spd.kelurahan AS kelurahan_suami, spd.pekerjaan AS pekerjaan_suami,
                spd.pendidikan AS pendidikan_suami, spd.nikah_ke AS nikah_ke_suami, spd.lama_nikah AS lama_nikah_suami, spd.sebab_pisah AS sebab_pisah_suami,
                spd.sebab_meninggal AS sebab_meninggal_suami, spd.no_regis_pasien_dewasa, spd.created_at AS created_at_suami, spd.updated_at AS updated_at_suami
                
                FROM `pasien_dewasa` pd
                LEFT JOIN `suami_pasien_dewasa` spd 
                ON pd.no_regis=spd.no_regis_pasien_dewasa
                WHERE pd.no_regis=?
                ORDER BY spd.id DESC
                LIMIT 1", [$id]);
        }
        //$pasien = json_decode(json_encode($pasien), true);

        $layanan = DB::select('SELECT format(l.tarif_total,"id-ID") str_tarif_total, format(l.tarif_layanan,"id-ID") str_tarif_layanan, ob.nama, format(ob.subtotal,"id-ID") str_subtotal, l.tarif_total, l.tarif_layanan, ob.subtotal, ob.qty, ob.id id_obat, l.id id_layanan 
            FROM layanan l LEFT JOIN (SELECT o.nama, o.kode_obat, ol.subtotal, ol.id_layanan, ol.qty, o.id FROM obat o LEFT JOIN obat_layanan ol ON o.id = ol.id_obat WHERE o.status_hapus <> 1) ob ON l.id = ob.id_layanan
            WHERE l.status_hapus <> 1 AND l.pelayanan = 3');

        $kspr = DB::select('SELECT * FROM master_kspr WHERE status_hapus = 0');
        $kspr_table = json_decode(json_encode($kspr), true);

        return view('layanan.ibu_hamil.detail_tambah', compact(['pasien', 'layanan', 'kspr_table']));
    }

    public function tambahHistoryHamil(request $request)
    {
        //echo "string";
        $string = "";
        $string .= "nomor_registrasi <BR>";
        $string .= $request->no_reg . "<BR>";


        $string .= "data riwayat hamil salin n kb <BR>";
        //$string .= $request->rdoHamilPertama . "<BR>";
        //$string .= $request->txthamilke . "<BR>";
        //$string .= $request->riwayat_hamil . "<BR>";


        //data riwayat kawin
        $string .= "data riwayat kawin <BR>";
        $string .= isset($request->riwayat_kawin) ? count($request->riwayat_kawin) : 0 . "<BR>";

        $string .= "data kehamilan sekarang <BR>";
        $string .= $request->txtg . "<BR>";
        $string .= $request->txtHaid . "<BR>";
        $string .= $request->txtHPHT . "<BR>";
        $string .= $request->txtHPL . "<BR>";
        $string .= $request->txtBBsblmhml . "<BR>";
        $string .= $request->txtMualMuntah . "<BR>";
        $string .= $request->txtmual . "<BR>";
        $string .= $request->txtPusing . "<BR>";
        $string .= $request->txtKeteranganPusing . "<BR>";
        $string .= $request->txtNyeriPerut . "<BR>";
        $string .= $request->txtKeteranganNyeriPerut . "<BR>";
        $string .= $request->txtGerakJanin . "<BR>";
        $string .= $request->txtketerangangerakJanin . "<BR>";
        $string .= $request->txtOedema . "<BR>";
        $string .= $request->txtKeteranganOedema . "<BR>";
        $string .= $request->txtNafsuMakan . "<BR>";
        $string .= $request->txtKeteranganNafsuMakan . "<BR>";
        $string .= $request->txtPendarahan . "<BR>";
        $string .= $request->txtPendarahansejak . "<BR>";
        $string .= $request->txt_keluhan_utama . "<BR>";
        $string .= $request->txtHasilKSPR . "<BR>";
        $string .= $request->txtDOTK . "<BR>";
        $string .= $request->txtDOM . "<BR>";
        $string .= $request->txt_rujuk_ke . "<BR>";
        $string .= $request->txt_penyakit_yang_diderita . "<BR>";
        $string .= $request->txt_riwayat_penyakit_keluarga . "<BR>";
        $string .= $request->txt_kebiasaan_ibu . "<BR>";
        $string .= $request->txtStatusTT . "<BR>";
        $string .= $request->tanggal_imunisasi . "<BR>";
        $string .= $request->txtResikoHIV . "<BR>";
        $string .= $request->txt_penyebab_hiv . "<BR>";


        $string .= "data pemeriksaan <BR>";
        $string .= $request->txtTB . "<BR>";
        $string .= $request->txtLILA . "<BR>";
        $string .= $request->txtIMT . "<BR>";
        $string .= $request->txtBentukTubuh . "<BR>";
        $string .= $request->txtKetBentukTubuh . "<BR>";
        $string .= $request->txtKesadaran . "<BR>";
        $string .= $request->txtketKesadaran . "<BR>";
        $string .= $request->txtMuka . "<BR>";
        $string .= $request->txtketMuka . "<BR>";
        $string .= $request->txtKulit . "<BR>";
        $string .= $request->txtketKulit . "<BR>";
        $string .= $request->txtMata . "<BR>";
        $string .= $request->txtketMata . "<BR>";
        $string .= $request->txtMulut . "<BR>";
        $string .= $request->txtketMulut . "<BR>";
        $string .= $request->txtGigi . "<BR>";
        $string .= $request->txtketGigi . "<BR>";
        $string .= $request->txtPemKel . "<BR>";
        $string .= $request->txtketPemKel . "<BR>";
        $string .= $request->txtDada . "<BR>";
        $string .= $request->txtParu . "<BR>";
        $string .= $request->txtketParu . "<BR>";
        $string .= $request->txtJantung . "<BR>";
        $string .= $request->txtketJantung . "<BR>";
        $string .= $request->txtPayudara . "<BR>";
        $string .= $request->txtketPayudara . "<BR>";
        $string .= $request->txtTangan . "<BR>";
        $string .= $request->txtRefleks . "<BR>";


        //data ibu dan ayah
        $string .= "data Ibu <BR>";
        $string .= $request->txtNamaibu . "<BR>";
        $string .= $request->txtTanggalLahiribu . "<BR>";
        $string .= $request->txtAgamaibu . "<BR>";
        $string .= $request->txtAlamatibu . "<BR>";
        $string .= $request->txtPhoneibu . "<BR>";
        $string .= $request->txtKelurahanibu . "<BR>";
        $string .= $request->txtPekerjaanibu . "<BR>";
        $string .= $request->txtPendidikanibu . "<BR>";
        $string .= $request->cboBukuKIA . "<BR>";
        $string .= $request->tglKIA . "<BR>";
        $string .= "data Ayah <BR>";
        $string .= $request->txtNamaayah . "<BR>";
        $string .= $request->txtTanggalLahirayah . "<BR>";
        $string .= $request->txtAgamaayah . "<BR>";
        $string .= $request->txtAlamatayah . "<BR>";
        $string .= $request->txtPhoneayah . "<BR>";
        $string .= $request->txtKelurahanayah . "<BR>";
        $string .= $request->txtPekerjaanayah . "<BR>";
        $string .= $request->txtPendidikanayah . "<BR>";

        $string .= "data Rencana Persalinan <BR>";
        $string .= $request->txtGolIbu;
        $string .= $request->txtGolAyah;
        $string .= $request->txtPenolongPersalinan;
        $string .= $request->txtTempat;
        $string .= $request->txtPendamping;
        $string .= $request->txtCalonDonor;
        $string .= $request->txtSticker;
        $string .= $request->txtTglPasang;
        $string .= $request->txtKesimpulanDiagnosa;

        $string .= "data Informed Consent <BR>";
        $string .= $request->riwayat_hamil;
        //$string .=$request->lampiran;
        $string .= $request->id_layanan;
        $string .= $request->harga_layanan;
        $string .= $request->harga_total;
        $string .= $request->list_obat;
        $string .= $request->list_qty;
        $string .= $request->harga_obat;
        DB::beginTransaction();

        try {
            $data_ibunya = DB::select('select * from pasien_dewasa where no_registrasi=?', [$request->no_reg]);
            $up_pasien_dewasa = PasienDewasa::find($request->no_reg);
            $up_pasien_dewasa->nama = $request->txtNamaibu;
            $up_pasien_dewasa->tanggal_lahir = date("Y-m-d", strtotime($request->txtTanggalLahiribu));
            $up_pasien_dewasa->agama = $request->txtAgamaibu;
            $up_pasien_dewasa->alamat = $request->txtAlamatibu;
            $up_pasien_dewasa->telp = $request->txtPhoneibu;
            $up_pasien_dewasa->kelurahan = $request->txtKelurahanibu;
            $up_pasien_dewasa->pekerjaan = $request->txtPekerjaanibu;
            $up_pasien_dewasa->pendidikan = $request->txtPendidikanibu;
            $up_pasien_dewasa->buku_kia = $request->cboBukuKIA;
            $up_pasien_dewasa->tgl_buku_kia = $request->tglKIA;
            $up_pasien_dewasa->save();

            $riwayat_kawinnya = isset($request->riwayat_kawin) ? count($request->riwayat_kawin) : 0;
            if ($riwayat_kawinnya > 0) {
                foreach ($request->riwayat_kawin as $key => $value) {
                    $splitan = explode(";", $value);
                    $new_suami_pasien_dewasa = new SuamiPasienDewasa();
                    $new_suami_pasien_dewasa->nama = $request->txtNamaayah;
                    $new_suami_pasien_dewasa->tanggal_lahir = date("Y-m-d", strtotime($request->txtTanggalLahirayah));
                    $new_suami_pasien_dewasa->agama = $request->txtAgamaayah;
                    $new_suami_pasien_dewasa->alamat = $request->txtAlamatayah;
                    $new_suami_pasien_dewasa->telp = $request->txtPhoneayah;
                    $new_suami_pasien_dewasa->kelurahan = $request->txtKelurahanayah;
                    $new_suami_pasien_dewasa->pekerjaan = $request->txtPekerjaanayah;
                    $new_suami_pasien_dewasa->pendidikan = $request->txtPendidikanayah;
                    $new_suami_pasien_dewasa->nikah_ke = $splitan[0];
                    $new_suami_pasien_dewasa->lama_nikah = $splitan[1];
                    $new_suami_pasien_dewasa->sebab_pisah = $splitan[2];
                    $new_suami_pasien_dewasa->sebab_meninggal = $splitan[3];
                    $new_suami_pasien_dewasa->no_regis_pasien_dewasa = $request->no_reg;
                    $new_suami_pasien_dewasa->save();
                }
            } else {
                //ditambah pengecekan buat kalau belum punya suami
                $check = SuamiPasienDewasa::where('no_regis_pasien_dewasa', $request->no_req)->exists();
                if ($check) {
                    DB::table('suami_pasien_dewasa')
                        ->where('no_regis_pasien_dewasa', $request->no_reg)
                        ->update(
                            [
                                'nama' => $request->txtNamaayah,
                                'tanggal_lahir' => date("Y-m-d", strtotime($request->txtTanggalLahirayah)),
                                'agama' => $request->txtAgamaayah,
                                'alamat' => $request->txtAlamatayah,
                                'telp' => $request->txtPhoneayah,
                                'kelurahan' => $request->txtKelurahanayah,
                                'pekerjaan' => $request->txtPekerjaanayah,
                                'pendidikan' => $request->txtPendidikanayah,
                            ]
                        );
                } else {
                    $new_suami_pasien_dewasa = new SuamiPasienDewasa();
                    $new_suami_pasien_dewasa->nama = $request->txtNamaayah;
                    $new_suami_pasien_dewasa->tanggal_lahir = date("Y-m-d", strtotime($request->txtTanggalLahirayah));
                    $new_suami_pasien_dewasa->agama = $request->txtAgamaayah;
                    $new_suami_pasien_dewasa->alamat = $request->txtAlamatayah;
                    $new_suami_pasien_dewasa->telp = $request->txtPhoneayah;
                    $new_suami_pasien_dewasa->kelurahan = $request->txtKelurahanayah;
                    $new_suami_pasien_dewasa->pekerjaan = $request->txtPekerjaanayah;
                    $new_suami_pasien_dewasa->pendidikan = $request->txtPendidikanayah;
                    $new_suami_pasien_dewasa->nikah_ke = 1;
                    $new_suami_pasien_dewasa->lama_nikah = 1;
                    $new_suami_pasien_dewasa->save();
                }
            }

            $rdoRujukan = $request->input('rdoRujukan');
            if (preg_match('/\bmerah\b/', $rdoRujukan)) {
                $savestring = "red;" . $rdoRujukan;
            } elseif (preg_match('/\bkuning\b/', $rdoRujukan)) {
                $savestring = "yellow;" . $rdoRujukan;
            } else {
                $savestring = "#47d147;" . $rdoRujukan;
            }

            // Add Ibu Hamil Layanan
            $new_ibu_hamil = new IbuHamil();
            $new_ibu_hamil->no_regis_pasien_dewasa = $request->no_reg;
            $new_ibu_hamil->tanggal = date('Y-m-d');
            $new_ibu_hamil->rujukan_terencana = $savestring;
            $new_ibu_hamil->g = $request->txtg;
            $new_ibu_hamil->haid = $request->txtHaid;
            $new_ibu_hamil->hpht = date("Y-m-d", strtotime($request->txtHPHT));
            $new_ibu_hamil->hpl = date("Y-m-d", strtotime($request->txtHPL));
            $new_ibu_hamil->bb_sebelum_hamil = str_replace(",", ".", $request->txtBBsblmhml);
            $new_ibu_hamil->mual_muntah = $request->txtMualMuntah;
            $new_ibu_hamil->ket_mual_muntah = $request->txtmual;
            $new_ibu_hamil->pusing = $request->txtPusing;
            $new_ibu_hamil->ket_pusing = $request->txtKeteranganPusing;
            $new_ibu_hamil->nyeri_perut = $request->txtNyeriPerut;
            $new_ibu_hamil->ket_nyeri_perut = $request->txtKeteranganNyeriPerut;
            $new_ibu_hamil->gerak_janin = $request->txtGerakJanin;
            $new_ibu_hamil->ket_gerak_janin = $request->txtketerangangerakJanin;
            $new_ibu_hamil->oedema = $request->txtOedema;
            $new_ibu_hamil->ket_oedema = $request->txtKeteranganOedema;
            $new_ibu_hamil->nafsu_makan = $request->txtNafsuMakan;
            $new_ibu_hamil->ket_nafsu_makan = $request->txtKeteranganNafsuMakan;
            $new_ibu_hamil->pendarahan = $request->txtPendarahan;
            $new_ibu_hamil->pendarahan_sejak = date('Y-m-d', strtotime($request->txtPendarahansejak));
            $new_ibu_hamil->keluhan_utama = $request->txt_keluhan_utama;
            $new_ibu_hamil->hasil_skor_kspr = $request->txtHasilKSPR;
            $new_ibu_hamil->dotk = $request->txtDOTK;
            $new_ibu_hamil->dom = $request->txtDOM;
            $new_ibu_hamil->rujuk_ke = $request->txt_rujuk_ke;
            $new_ibu_hamil->penyakit_yang_diderita = $request->txt_penyakit_yang_diderita;
            $new_ibu_hamil->riwayat_penyakit_keluarga = $request->txt_riwayat_penyakit_keluarga;
            $new_ibu_hamil->kebiasaan_ibu = $request->txt_kebiasaan_ibu;
            $new_ibu_hamil->statustt = $request->txtStatusTT;
            $new_ibu_hamil->tanggal_imunisasi = $request->tanggal_imunisasi;
            $new_ibu_hamil->resiko_hiv = $request->txtResikoHIV;
            $new_ibu_hamil->penyebab_hiv = $request->txt_penyebab_hiv;
            $new_ibu_hamil->tb = $request->txtTB;
            $new_ibu_hamil->lila = $request->txtLILA;
            $new_ibu_hamil->imt = $request->txtIMT;
            $new_ibu_hamil->bentuk_tubuh = $request->txtBentukTubuh;
            $new_ibu_hamil->ket_bentuk_tubuh = $request->txtKetBentukTubuh;
            $new_ibu_hamil->kesadaran = $request->txtKesadaran;
            $new_ibu_hamil->ket_kesadaran = $request->txtketKesadaran;
            $new_ibu_hamil->muka = $request->txtMuka;
            $new_ibu_hamil->ket_muka = $request->txtketMuka;
            $new_ibu_hamil->kulit = $request->txtKulit;
            $new_ibu_hamil->ket_kulit = $request->txtketKulit;
            $new_ibu_hamil->mata = $request->txtMata;
            $new_ibu_hamil->ket_mata = $request->txtketMata;
            $new_ibu_hamil->mulut = $request->txtMulut;
            $new_ibu_hamil->ket_mulut = $request->txtketMulut;
            $new_ibu_hamil->gigi = $request->txtGigi;
            $new_ibu_hamil->ket_gigi = $request->txtketGigil;
            $new_ibu_hamil->pembesaran_kel = $request->txtPemKel;
            $new_ibu_hamil->ket_pembesaran_kel = $request->txtketPemKel;
            $new_ibu_hamil->dada = $request->txtDada;
            $new_ibu_hamil->paru = $request->txtParu;
            $new_ibu_hamil->ket_paru = $request->txtketParu;
            $new_ibu_hamil->jantung = $request->txtJantung;
            $new_ibu_hamil->ket_jantung = $request->txtketJantung;
            $new_ibu_hamil->payudara = $request->txtPayudara;
            $new_ibu_hamil->ket_payudara = $request->txtketPayudara;
            $new_ibu_hamil->tangan_tungkai = $request->txtTangan;
            $new_ibu_hamil->refleks = $request->txtRefleks;
            $new_ibu_hamil->golongan_darah_ibu = 'golongan_darah_ibu';
            $new_ibu_hamil->golongan_darah_suami = 'golongan_darah_suami';
            $new_ibu_hamil->penolong = 'penolong';
            $new_ibu_hamil->tempat = 'tempat';
            $new_ibu_hamil->pendamping = 'pendamping';
            $new_ibu_hamil->calon_donor = 'calon_donor';
            $new_ibu_hamil->stiker_p4k = 'stiker_p4k';
            $new_ibu_hamil->dipasang_tanggal = 'dipasang_tanggal';
            $new_ibu_hamil->kesimpulan_diagnosa = 'kesimpulan_diagnosa';
            $new_ibu_hamil->status_hapus = 0;
            $new_ibu_hamil->save();
            $id_new_ibu_hamil = $new_ibu_hamil->id;
            // INSERT RIWAYAT KEHAMILAN
            if ($request->rdoHamilPertama != "ya") {

                $riwayat_hamil = DB::select("SELECT rk.`kehamilan_ke`, lih.`no_registrasi`, lih.*, rk.* FROM `layanan_ibu_hamil` lih
                    INNER JOIN `riwayat_kehamilan` rk
                    ON rk.`id_layanan_ibu_hamil`=lih.`id`
                    WHERE lih.no_registrasi=?
                    ORDER BY rk.`kehamilan_ke` DESC", [$request->no_reg]);
                $hamil_sekarang = isset($riwayat_hamil[0]->kehamilan_ke) ? $riwayat_hamil[0]->kehamilan_ke : 0;
                $arr_riwayat_hamil = explode(";", $request->riwayat_hamil);
                if ($arr_riwayat_hamil[0] != null) {
                    foreach ($arr_riwayat_hamil as $key_hamil => $value_hamil) {
                        $arrValue = explode("~", $value_hamil);
                        array_pop($arrValue);
                        $new_riwayat_kehamilan = new RiwayatKehamilan();
                        $new_riwayat_kehamilan->id_layanan_ibu_hamil = $id_new_ibu_hamil;
                        $new_riwayat_kehamilan->kehamilan_ke = $arrValue[0];
                        $new_riwayat_kehamilan->komplikasi = $arrValue[1];
                        $new_riwayat_kehamilan->persalinan = $arrValue[2];
                        $new_riwayat_kehamilan->tempat_persalinan = $arrValue[3];
                        $new_riwayat_kehamilan->komplikasi_persalinan = $arrValue[4];
                        $new_riwayat_kehamilan->penolong = $arrValue[5];
                        $new_riwayat_kehamilan->keadaan_bbl_kelamin = $arrValue[6];
                        $new_riwayat_kehamilan->keadaan_bbl_berat = str_replace(",", ".", $arrValue[7]);
                        $new_riwayat_kehamilan->keadaan_bbl = $arrValue[8];
                        $new_riwayat_kehamilan->keadaan_anak_sekarang = $arrValue[9];
                        $new_riwayat_kehamilan->ket_keadaan_anak_sekarang = $arrValue[10];
                        $new_riwayat_kehamilan->kb = $arrValue[11];
                        $new_riwayat_kehamilan->asi = $arrValue[12];
                        $new_riwayat_kehamilan->status_hapus = 0;
                        $new_riwayat_kehamilan->save();
                    }
                    $hamil_sekarang = $arrValue[0];
                }
                $hamil_sekarang++;
                $new_riwayat_kehamilan = new RiwayatKehamilan();
                $new_riwayat_kehamilan->id_layanan_ibu_hamil = $id_new_ibu_hamil;
                $new_riwayat_kehamilan->kehamilan_ke = $hamil_sekarang;
                $new_riwayat_kehamilan->komplikasi = '';
                $new_riwayat_kehamilan->persalinan = '';
                $new_riwayat_kehamilan->tempat_persalinan = '';
                $new_riwayat_kehamilan->komplikasi_persalinan = '';
                $new_riwayat_kehamilan->penolong = '';
                $new_riwayat_kehamilan->keadaan_bbl_kelamin = '';
                $new_riwayat_kehamilan->keadaan_bbl_berat = 0;
                $new_riwayat_kehamilan->keadaan_bbl = '';
                $new_riwayat_kehamilan->keadaan_anak_sekarang = '';
                $new_riwayat_kehamilan->ket_keadaan_anak_sekarang = '';
                $new_riwayat_kehamilan->kb = '';
                $new_riwayat_kehamilan->asi = '';
                $new_riwayat_kehamilan->status_hapus = 0;
                $new_riwayat_kehamilan->save();
            } else {
                $new_riwayat_kehamilan = new RiwayatKehamilan();
                $new_riwayat_kehamilan->id_layanan_ibu_hamil = $id_new_ibu_hamil;
                $new_riwayat_kehamilan->kehamilan_ke = 1;
                $new_riwayat_kehamilan->komplikasi = '';
                $new_riwayat_kehamilan->persalinan = '';
                $new_riwayat_kehamilan->tempat_persalinan = '';
                $new_riwayat_kehamilan->komplikasi_persalinan = '';
                $new_riwayat_kehamilan->penolong = '';
                $new_riwayat_kehamilan->keadaan_bbl_kelamin = '';
                $new_riwayat_kehamilan->keadaan_bbl_berat = 0;
                $new_riwayat_kehamilan->keadaan_bbl = '';
                $new_riwayat_kehamilan->keadaan_anak_sekarang = '';
                $new_riwayat_kehamilan->ket_keadaan_anak_sekarang = '';
                $new_riwayat_kehamilan->kb = '';
                $new_riwayat_kehamilan->asi = '';
                $new_riwayat_kehamilan->status_hapus = 0;
                $new_riwayat_kehamilan->save();
            }


            if ($request->lampiran) {
                foreach ($request->lampiran as $key => $value) {
                    $image = $value;
                    $extensions = $value->getClientOriginalExtension();
                    $filenameToSave = "lampiran_IH_" . $request->no_reg . "_" . date("Ymd") . "_" . ($key + 1) . "." . $extensions;
                    $destinationPath = public_path('/lampiran');
                    $imagePath = "lampiran/" . $filenameToSave;
                    $image->move($destinationPath, $filenameToSave);;

                    $new_lampiran = new lampiran();
                    $new_lampiran->jenis_layanan = '3';
                    $new_lampiran->id_layanan = $id_new_ibu_hamil;
                    $new_lampiran->tanggal = date("Y-m-d");
                    $new_lampiran->url_gambar = $imagePath;
                    $new_lampiran->no_registrasi_pasien = $request->no_reg;
                    $new_lampiran->save();
                }
            }

            // INSERT KSPR
            $list_kspr = $request->input('cboOpsi');
            $grandtotalkspr = $request->input('grandtotalkspr');
            $count_kspr = HeaderKspr::where('id_layanan_ibu_hamil', $id_new_ibu_hamil)->count();
            $new_header_kspr = new HeaderKspr();
            $new_header_kspr->judul = 'Triwulan ' . ($count_kspr + 1);
            $new_header_kspr->total_skor = $grandtotalkspr;
            $new_header_kspr->id_layanan_ibu_hamil = $id_new_ibu_hamil;
            $new_header_kspr->save();

            $id_new_header_kspr = $new_header_kspr->id;


            $master_kspr = MasterKspr::where('status_hapus', 0)->get();

            foreach ($master_kspr as $key => $value) {
                if ($value['urutan'] == 0) {
                    $skorkspr = 2;
                } else {
                    $skorkspr = $list_kspr[$key - 1];
                }

                $new_history_kspr = new HistoryKspr();
                $new_history_kspr->skor = $skorkspr;
                $new_history_kspr->id_header_kspr = $id_new_header_kspr;
                $new_history_kspr->id_master_kspr = $value['id'];
                $new_history_kspr->save();
            }

            // INSERT TRANSAKSI
            $new_transaksi = new Transaksi();
            $new_transaksi->jenis_layanan = '3';
            $new_transaksi->id_layanan = $id_new_ibu_hamil;
            $new_transaksi->harga_obat = $request->harga_obat;
            $new_transaksi->harga_layanan = $request->harga_layanan;
            $new_transaksi->total_harga = $request->harga_total;
            $new_transaksi->tanggal = date("Y-m-d");
            $new_transaksi->users_id = Auth::user()->id;
            $new_transaksi->save();

            // INSERT LAYANAN IBU Hamil 
            $new_history_layanan_ibu_hamil = new HistoryLayananIbuHamil();
            $new_history_layanan_ibu_hamil->id_layanan_ibu_hamil = $id_new_ibu_hamil;
            $new_history_layanan_ibu_hamil->tanggal = date("Y-m-d");
            $new_history_layanan_ibu_hamil->keluhan = "Kedatangan Pertama";
            $new_history_layanan_ibu_hamil->save();
            $id_new_history_layanan_ibu_hamil = $new_history_layanan_ibu_hamil->id();

            $arrListObat = explode(";", $request->list_obat);
            $arrListQty = explode(";", $request->list_qty);
            array_pop($arrListObat);
            array_pop($arrListQty);

            if (!empty($arrListObat) && $arrListObat[0] != "") {
                foreach ($arrListObat as $key => $value) {
                    $new_his_obat = new HistoryIbuHamilObat();
                    $new_his_obat->id_history_ibu_hamil =  $id_new_history_layanan_ibu_hamil;
                    $new_his_obat->id_obat = $value;
                    $new_his_obat->qty = $arrListQty[$key];
                    $new_his_obat->save();

                    // UPDATE STOK OBAT
                    $obat = Obat::find($value);
                    $sisa_stok = $obat->total_pcs - (int)$arrListQty[$key];

                    $obat->total_pcs = $sisa_stok;
                    $obat->save();
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            print_r($e->getMessage());
            die();
            return redirect('/layanan-ibu-hamil/' . $request->no_reg)->with(['danger_message' => 'Data kehamilan gagal disimpan.']);
        }

        return redirect('/layanan-ibu-hamil/' . $request->no_reg)->with(['message' => 'Data kehamilan berhasil disimpan.']);
    }


    // Kunjungan

    public function createKunjunganIbuHamil($id)
    {
        // $id=$request->id_layanan;
        // $layanan = JenisLayanan::where('pelayanan',3)->get();
        $layanan = DB::select('SELECT format(l.tarif_total,"id-ID") str_tarif_total, format(l.tarif_layanan,"id-ID") str_tarif_layanan, ob.nama, format(ob.subtotal,"id-ID") str_subtotal, l.tarif_total, l.tarif_layanan, ob.subtotal, ob.qty, ob.id id_obat, l.id id_layanan 
        FROM layanan l LEFT JOIN (SELECT o.nama, o.kode_obat, ol.subtotal, ol.id_layanan, ol.qty, o.id FROM obat o LEFT JOIN obat_layanan ol ON o.id = ol.id_obat WHERE o.status_hapus <> 1) ob ON l.id = ob.id_layanan
        WHERE l.status_hapus <> 1 AND l.pelayanan = 3');
        // dd($layanan);
        return view('layanan.ibu_hamil.tambah_history_kunjungan', compact(['id', 'layanan']));
    }

    public function tambahKunjunganIbuHamil(request $request)
    {

        $string = $request->id_layanan;
        $string .= "<br>" . $request->id_layanan;
        $string .= "<br>" . $request->txtTanggal;
        $string .= "<br>" . $request->txtKeluhan;
        $string .= "<br>" . $request->txtbukukia;
        $string .= "<br>" . $request->txtBB;
        $string .= "<br>" . $request->txtTD;
        $string .= "<br>" . $request->txtNadi;
        $string .= "<br>" . $request->txtRR;
        $string .= "<br>" . $request->txtAbdomen;
        $string .= "<br>" . $request->txtOedemTungkai;
        $string .= "<br>" . $request->txtTFU;
        $string .= "<br>" . $request->txtLTJanin;
        $string .= "<br>" . $request->txtDJJ;
        $string .= "<br>" . $request->txtgerakjanin;
        $string .= "<br>" . $request->txtUK;
        $string .= "<br>" . $request->txtLab;
        $string .= "<br>" . $request->txtSkor;
        $string .= "<br>" . $request->txtAnalisaMasalah;
        $string .= "<br>" . $request->txtPenyuluhan;
        $string .= "<br>" . $request->txtTerapiTT;
        $string .= "<br>" . $request->txtRujukKe;


        $arrObat = explode(";", $request->obatnya);
        $idObat = explode(",", $arrObat[0]);
        $qtyObat = explode(",", $arrObat[1]);

        //return $string;

        DB::beginTransaction();

        try {
            $new_history_layanan_ibu_hamil = new HistoryLayananIbuHamil();
            $new_history_layanan_ibu_hamil->id_layanan_ibu_hamil = $request->id_layanan;
            $new_history_layanan_ibu_hamil->tanggal = date('Y-m-d', strtotime($request->txtTanggal));
            $new_history_layanan_ibu_hamil->keluhan = $request->txtKeluhan;
            $new_history_layanan_ibu_hamil->bawa_buku_kia = $request->txtbukukia;
            $new_history_layanan_ibu_hamil->bb = str_replace(",", ".", $request->txtBB);
            $new_history_layanan_ibu_hamil->td = $request->txtTD;
            $new_history_layanan_ibu_hamil->nadi = $request->txtNadi;
            $new_history_layanan_ibu_hamil->rr = $request->txtRR;
            $new_history_layanan_ibu_hamil->abdomen = $request->txtAbdomen;
            $new_history_layanan_ibu_hamil->oedem_tungkai = $request->txtOedemTungkai;
            $new_history_layanan_ibu_hamil->tfu = $request->txtTFU;
            $new_history_layanan_ibu_hamil->lt_janin = $request->txtLTJanin;
            $new_history_layanan_ibu_hamil->djj = $request->txtDJJ;
            $new_history_layanan_ibu_hamil->gerak_janin = $request->txtgerakjanin;
            $new_history_layanan_ibu_hamil->uk = $request->txtUK;
            $new_history_layanan_ibu_hamil->lab = $request->txtLab;
            $new_history_layanan_ibu_hamil->skor = $request->txtSkor;
            $new_history_layanan_ibu_hamil->analisa_masalah = $request->txtAnalisaMasalah;
            $new_history_layanan_ibu_hamil->penyuluhan = $request->txtPenyuluhan;
            $new_history_layanan_ibu_hamil->terapi_tt = $request->txtTerapiTT;
            $new_history_layanan_ibu_hamil->rujuk_ke = $request->txtRujukKe;
            $new_history_layanan_ibu_hamil->save();

            $id_new_history_layanan_ibu_hamil = $new_history_layanan_ibu_hamil->id_new_history_layanan;

            $total_harga_obat = 0;
            if ($idObat[0] != null) {
                foreach ($idObat as $key => $value) {
                    $obat = Obat::find($value);
                    $ttl_hrg_obt = $obat->harga * (int)$qtyObat[$key];

                    $stok_update = $obat->total_pcs - (int)$qtyObat[$key];

                    $obat->total_pcs = $stok_update;
                    $obat->save();
                    $new_his_obat = new HistoryIbuHamilObat();
                    $new_his_obat->id_history_ibu_hamil =  $id_new_history_layanan_ibu_hamil;
                    $new_his_obat->id_obat = $value;
                    $new_his_obat->qty = $qtyObat[$key];
                    $new_his_obat->save();
                    // $obat->ibuHamil()->attach( $id_new_history_layanan_ibu_hamil,['qty' =>  $qtyObat[$key]]);

                    $total_harga_obat += $ttl_hrg_obt;
                }
            }

            $total_harga = $total_harga_obat + (int)str_replace(',', '', $request->harga_layanannya);
            $new_transaksi = new Transaksi();
            $new_transaksi->jenis_layanan = "4";
            $new_transaksi->id_layanan = $new_history_layanan_ibu_hamil;
            $new_transaksi->harga_obat = $total_harga_obat;
            $new_transaksi->harga_layanan = (int)str_replace(',', '', $request->harga_layanannya);
            $new_transaksi->total_harga = $total_harga;
            $new_transaksi->tanggal = date("Y-m-d H:i:s");
            $new_transaksi->save();


            DB::commit();
            return redirect('/layananIbuHamilDetail/detailKartu/' . $request->id_layanan)->with(['message' => 'Data history kehamilan berhasil disimpan.']);
        } catch (\Exception $e) {
            DB::rollback();
            //Log::error($e->getMessage());
            return redirect('/layananIbuHamilDetail/detailKartu/' . $request->id_layanan)->with(['danger_message' => 'Data history kehamilan gagal disimpan.']);
        }
    }

    // KSPR
    public function indexKspr($id)
    {
        // $header = DB::select('SELECT hkspr.id, hkspr.judul, hkspr.total_skor, lh.no_registrasi, hkspr.id_layanan_ibu_hamil, lh.rujukan_terencana FROM header_kspr hkspr LEFT JOIN layanan_ibu_hamil lh ON lh.id = hkspr.id_layanan_ibu_hamil WHERE hkspr.id_layanan_ibu_hamil = "'.$id.'"');
        $header_kspr = HeaderKspr::where('id_layanan_ibu_hamil',$id)->get();

        $arrData = array([]);
        $isLast = false;
        foreach ($header_kspr as $key => $value) {
            // $kspr = DB::select('SELECT hk.judul, hk.total_skor total_skor_1, mk.text, mk.urutan, mk.opsi FROM (SELECT hkspr.id, hkspr.judul, hkspr.total_skor, lh.no_regis_pasien_dewasa FROM header_kspr hkspr LEFT JOIN layanan_ibu_hamil lh ON lh.id = hkspr.id_layanan_ibu_hamil WHERE hkspr.id_layanan_ibu_hamil = "'.$id.'" AND hkspr.id = "'.$value['id'].'") hk LEFT JOIN history_kspr hist ON hk.id = hist.id_header_kspr LEFT JOIN master_kspr mk ON hist.id_master_kspr = mk.id ORDER BY mk.id ASC');
            
            // $kspr_table = MasterKspr

            // if($key == 0){
            //     $arrData[] = $kspr_table;
            // }
            // else{
            //     foreach ($kspr_table as $keykspr => $valuekspr) {
            //         if(strpos($valuekspr['judul'], '4')){
            //             $isLast = true;
            //         }

            //         $arrData[0][$keykspr]['skor_'.($key+1)] = $valuekspr['skor_1'];
            //         $arrData[0][$keykspr]['total_skor_'.($key+1)] = $valuekspr['total_skor_1'];
            //     }
            // }
        }

        return view('layanan.ibu_hamil.detail_kartu_Kspr', compact(['arrData', 'header_kspr', 'isLast']));
    }

    // Penapisan
    public function indexPenapisan($id)
    {
        $idibuhamil = $id;
        $header = DB::select('SELECT mp.kriteria kriteria, IF(hp.jawaban = 0, "Tidak", "Ya") jawab, DATE_FORMAT(head.tanggal, "%d-%m-%Y") tanggal, head.jam FROM history_penapisan hp LEFT JOIN master_penapisan mp ON hp.id_master_penapisan = mp.id LEFT JOIN header_penapisan head ON hp.id_header_penapisan = head.id WHERE head.id_layanan_ibu_hamil = "'.$idibuhamil.'"');
        $header_table = json_decode(json_encode($header), true);

        $penapisan = DB::select('SELECT * FROM master_penapisan WHERE status_hapus = 0');
        $penapisan_table = json_decode(json_encode($penapisan), true);
        
        $isExist = false;
        $data = array();
        if(count($header_table) > 0){
            $isExist = true;
            $data = $header_table;
        }
        else{
            $data = $penapisan_table;
        }


        $pasien = DB::select('SELECT p.nama FROM layanan_ibu_hamil l LEFT JOIN pasien_dewasa p ON l.no_registrasi = p.no_registrasi WHERE l.id = "'.$id.'"');
        $nama_pasien = $pasien[0]->nama;

        return view('layanan.ibu_hamil.detail_kartu_penapisan', compact(['isExist', 'data', 'idibuhamil', 'nama_pasien']));
    }

    public function storePenapisan(Request $request)
    {
        $list_penapisan = $request->input('cboOpsi');
        try {
            // INSERT PENAPISAN
            DB::table('header_penapisan')->insert(
                [
                    'tanggal' => date("Y-m-d", strtotime($request->input('txtTanggal'))),
                    'jam' => date("H:i:s", strtotime($request->input('txtJam'))),
                    'nama' => $request->input('txtNama'),
                    'id_layanan_ibu_hamil' => $request->input('id_layanan_ibu_hamil'),
                    "created_at" => date("Y-m-d H:i:s"),
                    "updated_at" => date("Y-m-d H:i:s")
                ]
            );

            $id_header_penapisan = DB::table('header_penapisan')->where('id_layanan_ibu_hamil', $request->input('id_layanan_ibu_hamil'))->orderBy('id', 'DESC')->first();

            $penapisan = DB::select('SELECT * FROM master_penapisan WHERE status_hapus = 0');
            $penapisan_table = json_decode(json_encode($penapisan), true);

            foreach ($penapisan_table as $key => $value) {
                DB::table('history_penapisan')->insert(
                    [
                        'jawaban' => $list_penapisan[$key],
                        'id_header_penapisan' => $id_header_penapisan->id,
                        'id_master_penapisan' => $value['id'],
                        "created_at" => date("Y-m-d H:i:s"),
                        "updated_at" => date("Y-m-d H:i:s")
                    ]
                );
            }
        } catch (\Exception $e) {
            DB::rollback();
            // print_r($e->getMessage());
            // die();
            return redirect()->back()->with(['danger_message'=>'Data transaksi gagal disimpan.']);
                // something went wrong
        }

        return redirect()->back()->with(['message'=>'Kartu KSPR berhasil disimpan.']);
    }

}
