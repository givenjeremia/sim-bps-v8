<?php

namespace App\Http\Controllers\layanan;

use Dompdf\Dompdf;
use Barryvdh\DomPDF\PDF;
use App\Models\Transaksi;
use App\Models\master\Obat;
use Illuminate\Http\Request;

use App\Models\layanan\Klinik;
use App\Models\master\PasienBayi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\master\PasienDewasa;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class KlinikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasienBayi = PasienBayi::select('no_regis_pasien_dewasa', 'nama', 'tanggal_lahir', 'alamat', 'telp')->where('status_hapus', 0);
        $pasienDewasa = PasienDewasa::select('no_regis', 'nama', 'tanggal_lahir', 'alamat', 'telp')->where('status_hapus', 0);
        $pasien = $pasienBayi->union($pasienDewasa)->get();
        return view('layanan.klinik.index', compact('pasien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // if(substr($id,0,2)=='OD'){
        //     $pasien = DB::table('pasien_dewasa')->where('no_registrasi',$id)->get();
        // }
        // else {
        //     $pasien = DB::table('pasien_bayi')->where('no_registrasi',$id)->get();
        //     $pasien[0]->agama = '-';
        // }
        // $pasien = json_decode(json_encode($pasien), true);
        // return view('layanan\klinikDetail', compact('pasien'));
        $pasien = array();
        $pasien[0]['id'] = "1"; 
        $pasien[0]['no_reg'] = "AB00001"; 
        $pasien[0]['nama'] = "Bayu Gatra";
        $pasien[0]['ttl'] = "20/02/2018";
        $pasien[0]['alamat'] = "Jl. Mangga No.2A, Sidoarjo";
        $pasien[0]['telp'] = "082222313444";


        $pasien[1]['id'] = "2"; 
        $pasien[1]['no_reg'] = "OT00001"; 
        $pasien[1]['nama'] = "Sutisna Yahya Aji";
        $pasien[1]['ttl'] = "01/04/2018";
        $pasien[1]['alamat'] = "Jl. Mangga No.2A, Sidoarjo"; 
        $pasien[1]['telp'] = "082222313444"; 

        $pasien[2]['id'] = "3"; 
        $pasien[2]['no_reg'] = "OT00002"; 
        $pasien[2]['nama'] = "Maharani";
        $pasien[2]['ttl'] = "10/02/2018";
        $pasien[2]['alamat'] = "Jl. Mangga No.2A, Sidoarjo"; 
        $pasien[2]['telp'] = "082222313444"; 

        return view('layanan.klinik.tambah', compact('pasien'));
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
     * @param  \App\Models\Klinik  $klinik
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if(substr($id,0,2)=='PD'){
            $pasien = PasienDewasa::where('no_regis',$id)->get();
        }
        else {
            $pasien = PasienBayi::where('no_regis_pasien_dewasa',$id)->get();
            $pasien[0]->agama = '-';
        }
        $klinik = Klinik::where('no_regis_pasien_dewasa',$id)->get();

        return view('layanan.klinik.detail', compact('pasien','klinik'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Klinik  $klinik
     * @return \Illuminate\Http\Response
     */
    public function edit(Klinik $klinik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Klinik  $klinik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Klinik $klinik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Klinik  $klinik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Klinik $klinik)
    {
        //
    }

    public function klinik_cek_stok_obat(Request $request){
        $arrObat = explode(";", $request->obatnya);
        $idObat = explode(",", $arrObat[0]);
        $qtyObat = explode(",", $arrObat[1]);
        $error = array();
        if(!empty($id_obat) && $id_obat[0] != ""){
            foreach ($idObat as $key => $value) {
                $obatnya = Obat::where('id',$value)->get();
                if($qtyObat[$key] > $obatnya[0]->total_pcs){
                    array_push($error, $obatnya[0]->nama." melebihi stok (".$obatnya[0]->total_pcs.") <br>");
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
        else{
            echo "";
        }
        //echo " masuk";
    }

    public function detailTambah(request $request)
    {
        $id=$request->no_registrasi;
        if(substr($id,0,2)=='PD'){
            $pasien = PasienDewasa::where('no_regis',$id)->get();
        }
        else {
            $pasien = PasienBayi::where('no_regis_pasien_dewasa',$id)->get();
            $pasien[0]->agama = '-';
        }

        $klinik = Klinik::where('no_regis_pasien_dewasa',$id)->get();
        $obat = Obat::all();
        return view('layanan.klinik.detail_tambah', compact('pasien','klinik','obat'));
    }

    public function klinik_simpan_history(Request $request)
    {
        // User Login
        $user = Auth::user();

        $arrObat = explode(";", $request->obatnya);
        $idObat = explode(",", $arrObat[0]);
        $qtyObat = explode(",", $arrObat[1]);
        
        
        DB::beginTransaction();

        try {
            $new_klinik = new Klinik();
            $new_klinik->keluhan = $request->keluhannya;
            $new_klinik->tindakan = $request->tindakannya;
            $new_klinik->tanggal = date("Y-m-d H:i:s");
            $new_klinik->no_regis_pasien_dewasa = $request->idSimpan;
            $new_klinik->users_id = $user->id;
            $new_klinik->save();
            $total_harga_obat = 0;
            if($idObat[0]!=null){
                foreach ($idObat as $key => $value) {
                    $obat = Obat::find($value);
                    // dd($obat->harga);
                    $ttl_hrg_obt = $obat->harga*(int)$qtyObat[$key];
                    // dd($ttl_hrg_obt);
                    $stok_update = $obat->total_pcs-(int)$qtyObat[$key];

                    $obat->total_pcs = $stok_update;
                    $obat->save();
                    // obat_layanan(
                    $obat->layanan()->attach($new_klinik->id,[
                        'qty' =>$qtyObat[$key],
                        'subtotal' => $ttl_hrg_obt
                    ]);
            
                    $total_harga_obat+=$ttl_hrg_obt;
                }
            }
            

            $total_harga = $total_harga_obat+(int)str_replace(',', '', $request->harga_layanannya);
            $new_transaksi = new Transaksi();
            $new_transaksi->jenis_layanan = "KLINIK";
            $new_transaksi->id_layanan = $new_klinik->id;
            $new_transaksi->harga_obat = $total_harga_obat;
            $new_transaksi->harga_layanan = (int)str_replace(',', '', $request->harga_layanannya);
            $new_transaksi->total_harga = $total_harga;
            $new_transaksi->users_id = $user->id;
            $new_transaksi->tanggal = date("Y-m-d H:i:s");
            $new_transaksi->save();

            DB::commit();
            return redirect('/layanan-klinik/'.$request->idSimpan)->with(['message'=>'Data transaksi berhasil disimpan.']);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect('/layanan-klinik/'.$request->idSimpan)->with(['danger_message'=>'Data transaksi gagal disimpan.'.$e->getMessage()]);
        }



    }

    public function tambah_pasien_history(Request $request)
    {
        
        $noreg = PasienDewasa::generateNoRegister();

        $nama = $request->namanya;
        $tanggal_lahir = $request->tlnya;
        $agama = $request->agamanya;
        $alamat = $request->alamatnya;
        $no_telp = $request->notelpnya;
        $arrObat = explode(";", $request->obatnya);
        $idObat = explode(",", $arrObat[0]);
        $qtyObat = explode(",", $arrObat[1]);
        
        DB::beginTransaction();

        try {
            $new_pasien_dewasa = new PasienDewasa();
            $new_pasien_dewasa->no_regis = $noreg;
            $new_pasien_dewasa->nama = $nama;
            $new_pasien_dewasa->tanggal_lahir = date("Y-m-d", strtotime($tanggal_lahir));
            $new_pasien_dewasa->agama = $agama;
            $new_pasien_dewasa->alamat = $alamat;
            $new_pasien_dewasa->telp = $no_telp;
            $new_pasien_dewasa->kelurahan = '';
            $new_pasien_dewasa->pekerjaan = '';
            $new_pasien_dewasa->pendidikan = '';
            $new_pasien_dewasa->buku_kia = '';
            $new_pasien_dewasa->tgl_buku_kia = null;
            $new_pasien_dewasa->status_hapus = 0;
            $new_pasien_dewasa->save();
            $id_new_pasien_dewasa = $new_pasien_dewasa->no_regis;
            
            // Klinik 
            $new_klinik = new Klinik();
            $new_klinik->tanggal = date("Y-m-d H:i:s");
            $new_klinik->keluhan = $request->keluhannya;
            $new_klinik->tindakan = $request->tindakannya;
            $new_klinik->no_regis_pasien_dewasa = $id_new_pasien_dewasa;
            $new_klinik->users_id = Auth::user()->id;
            $new_klinik->save();

            $id_new_klinik =  $new_klinik->id;

            $total_harga_obat = 0;
            if($idObat[0]!=null){
                foreach ($idObat as $key => $value) {
                    $obat = Obat::find($value);

                    $ttl_hrg_obt = $obat->harga*(int)$qtyObat[$key];
                    $stok_update = $obat->total_pcs-(int)$qtyObat[$key];

                    $obat->total_pcs = $stok_update;
                    $obat->save();
                    $obat->klinik()->attach($id_new_klinik,['qty' => $qtyObat[$key],'harga_obat' => $obat->harga, 'total_harga_obat'=>$ttl_hrg_obt]);
                    $total_harga_obat+=$ttl_hrg_obt;
                }
            }
            
            $total_harga = $total_harga_obat+(int)str_replace(',', '', $request->harga_layanannya);
            $new_transaksi = new Transaksi();
            $new_transaksi->jenis_layanan = "KLINIK";
            $new_transaksi->id_layanan = $id_new_klinik;
            $new_transaksi->harga_obat = $total_harga_obat;
            $new_transaksi->harga_layanan = (int)str_replace(',', '', $request->harga_layanannya);
            $new_transaksi->total_harga = $total_harga;
            $new_transaksi->tanggal = date("Y-m-d H:i:s");
            $new_transaksi->users_id = Auth::user()->id;
            $new_transaksi->save();

            DB::commit();
            return redirect('/layanan-klinik/'.$noreg)->with(['message'=>'Data transaksi berhasil disimpan.']);
        } catch (\Exception $e) {
            DB::rollback();
            dd($e->getMessage());
            return redirect('/layanan-klinik')->with(['danger_message'=>'Data transaksi gagal disimpan.'.$e->getMessage()]);
        }

    }

    public function klinik_tambah_pasien_bayi_history(Request $request)
    {
        $pasien_bayi = DB::table('pasien_bayi')->where('status_hapus', '<>', 1)->orderBy('id', 'desc')->first();
        $noreg = (!empty($pasien_bayi)) ? 'AB'.date("Ymd").($pasien_bayi->id + 1) : 'OD'.date("Ymd")."1";

        $nama = $request->namanya2;
        $tanggal_lahir = $request->tlnya2;
        $agama = $request->agamanya2;
        $alamat = $request->alamatnya2;
        $no_telp = $request->notelpnya2;
        $arrObat = explode(";", $request->obatnya2);
        $idObat = explode(",", $arrObat[0]);
        $qtyObat = explode(",", $arrObat[1]);
        $kelurahan = $request->kelurahan2;
        $asal_wilayah = $request->asalwilayah2;
        $kelamin = $request->kelamin2;
        
        DB::beginTransaction();

        try {
            DB::table('pasien_bayi')->insert(
                [
                    'nama' => $nama,
                    'tanggal_lahir' => date("Y-m-d", strtotime($tanggal_lahir)),
                    'bbl' => 0,
                    'kelamin' => $kelamin,
                    'cara_persalinan' => '',
                    'kelurahan' => $kelurahan,
                    'asal_wilayah' => $asal_wilayah,
                    'alamat' => $alamat,
                    'nama_ayah' => '',
                    'nama_ibu' => '',
                    'telp' => $no_telp,
                    'status_hapus' => 0,
                    'no_registrasi' => $noreg,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id
                ]
            );

            DB::table('layanan_klinik')->insert(
                [
                    'tanggal' => date("Y-m-d H:i:s"),
                    'keluhan' => $request->keluhannya2,
                    'tindakan' => $request->tindakannya2,
                    'no_registrasi' => $noreg,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id
                ]
            );

            $layanan_klinik_inserted = DB::table('layanan_klinik')->orderBy('id', 'desc')->first();

            $total_harga_obat = 0;
            if($idObat[0]!=null){
                foreach ($idObat as $key => $value) {
                    $obat = DB::table('obat')->where('id', $value)->get();
                    $ttl_hrg_obt = $obat[0]->harga*(int)$qtyObat[$key];

                    $stok_update = $obat[0]->total_pcs-(int)$qtyObat[$key];

                    DB::table('obat')->where('id', $value)->update(
                        [
                            'total_pcs' => $stok_update,
                            'updated_by' => Auth::user()->id
                        ]
                    );

                    DB::table('klinik_obat')->insert(
                        [
                            'id_obat' => $value,
                            'id_layanan' => $layanan_klinik_inserted->id,
                            'qty' => $qtyObat[$key],
                            'harga_obat' => $obat[0]->harga,
                            'total_harga_obat' => $ttl_hrg_obt
                        ]
                    );
                    $total_harga_obat+=$ttl_hrg_obt;
                }
            }


            $total_harga = $total_harga_obat+(int)str_replace(',', '', $request->harga_layanannya);
            DB::table('transaksi')->insert(
                [
                    'jenis_layanan' => "KLINIK",
                    'id_layanan' => $layanan_klinik_inserted->id,
                    'harga_obat' => $total_harga_obat,
                    'harga_layanan' => (int)str_replace(',', '', $request->harga_layanannya),
                    'total_harga' => $total_harga,
                    'tanggal' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s"),
                    'created_by' => Auth::user()->id,
                    'updated_by' => Auth::user()->id
                ]
            );

            DB::commit();
                // all good
        } catch (\Exception $e) {
            DB::rollback();
            // print_r($e->getMessage());
            // die();
            return redirect('/klinik')->with(['danger_message'=>'Data transaksi gagal disimpan.']);
                // something went wrong
        }
        return redirect('/klinik/'.$noreg)->with(['message'=>'Data transaksi berhasil disimpan.']);
    }


    // Cetak
    public function cetakSuratKetSakit(Request $request){

        $id=$request->no_registrasi;
        // dd($id);
        if(substr($id,0,2)=='PD'){
            $pasien = DB::table('pasien_dewasa')->where('no_regis',$id)->get();
        }
        else {
            # code...
            $pasien = DB::table('pasien_bayi')->where('no_regis_pasien_dewasa',$id)->get();
            $pasien[0]->pekerjaan = 'Belum Bekerja';
        }

        $data = [
            'nama' => $pasien[0]->nama,
            'umur' => date("Y", strtotime(now()))-date("Y", strtotime($pasien[0]->tanggal_lahir)),
            'pekerjaan' => $pasien[0]->pekerjaan,
            'alamat'=> $pasien[0]->alamat,
            'lama_istirahat' => $request->txtlamaIstirahat,
            'tanggal_awal' => date("d M Y", strtotime($request->txtTanggalAwal)),
            'tanggal_akhir' => date("d M Y", strtotime($request->txtTanggalAkhir))
        ];
        $dompdf = new Dompdf();
        $dompdf->loadHtml(View::make('layanan.klinik.surat_ket_sakit', compact('data') )->render());
        $dompdf->render();
        $title = 'sks';
        return $dompdf->stream($title, ['Attachment' => false]);
    }

    public function cetakSuratRujukan(Request $request){
        $id=$request->no_registrasi;
        
        if(substr($id,0,2)=='PD'){
            $pasien = DB::table('pasien_dewasa')->where('no_regis',$id)->get();
        }
        else {
            # code...
            $pasien = DB::table('pasien_bayi')->where('no_registrasi',$id)->get();
            $pasien[0]->pekerjaan = 'Belum Bekerja';
        }
        $data = [
            'nama' => $pasien[0]->nama,
            'umur' => date("Y", strtotime(now()))-date("Y", strtotime($pasien[0]->tanggal_lahir)),
            'pekerjaan' => $pasien[0]->pekerjaan,
            'alamat'=> $pasien[0]->alamat,
            'kepada' => $request->txtKepada,
            'kepadaRs' => $request->txtKepadaRs,
            'anamnese' => $request->txtAnamnese,
            'tindakan' => $request->txtTindakan,
            'diagnosa' => $request->txtDiagnosa,
        ];

        $dompdf = new Dompdf();
        $dompdf->loadHtml(View::make('layanan.klinik.surat_rujukan', compact('data') )->render());
        $dompdf->render();
        $title = 'skr';
        return $dompdf->stream($title, ['Attachment' => false]);
    }


}
