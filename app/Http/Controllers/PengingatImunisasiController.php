<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengingatImunisasiController extends Controller
{
    //
    public function indexHariIni()
    {
        // return strtotime("2018-09-11")." ".DATEDIFF(date("Y-m-d"));
        $bayi = DB::select("SELECT pb.id as idbayi,ijl.tanggal as tanggal, l.nama as jenisImunisasi, pb.no_registrasi, pb.nama, pb.nama_ayah, pb.nama_ibu, pb.telp,l.id as idLayanan FROM imunisasi_jenis_layanan as ijl, layanan_imunisasi as li, pasien_bayi as pb, layanan as l WHERE ijl.id_layanan_imuniasasi = li.id AND li.no_registrasi = pb.no_registrasi AND ijl.id_jenis_layanan = l.id AND ijl.status_imunisasi = 0 AND pb.status_hapus=0 AND DATEDIFF(ijl.tanggal,'".date("Y-m-d")."')=0");

        return view('pengingat.imunisasi.hariIni', compact('bayi'));
    }

    public function indexTerlewati()
    {
        $bayi = DB::select("SELECT pb.id as idbayi,ijl.tanggal, l.nama as jenisImunisasi, pb.no_registrasi, pb.nama, pb.nama_ayah, pb.nama_ibu, pb.telp FROM imunisasi_jenis_layanan as ijl, layanan_imunisasi as li, pasien_bayi as pb, layanan as l WHERE ijl.id_layanan_imuniasasi = li.id AND li.no_registrasi = pb.no_registrasi AND ijl.id_jenis_layanan = l.id AND ijl.status_imunisasi = 0 AND pb.status_hapus=0 AND DATEDIFF(ijl.tanggal,'".date("Y-m-d")."')<0");
        dd($bayi);
        return view('pengingat.imunisasi.terlewati', compact('bayi'));
    }

    public function indexAkanDatang()
    {
        $bayi = DB::select("SELECT pb.id as idbayi, ijl.tanggal, l.nama as jenisImunisasi, pb.no_registrasi, pb.nama, pb.nama_ayah, pb.nama_ibu, pb.telp FROM imunisasi_jenis_layanan as ijl, layanan_imunisasi as li, pasien_bayi as pb, layanan as l WHERE ijl.id_layanan_imuniasasi = li.id AND li.no_registrasi = pb.no_registrasi AND ijl.id_jenis_layanan = l.id AND ijl.status_imunisasi = 0 AND pb.status_hapus=0 AND (ijl.tanggal BETWEEN '".date("Y-m-d")."' AND '".date('Y-m-d', strtotime(date("Y-m-d"). ' +3 day'))."')");
        return view('pengingat.imunisasi.akanDatang', compact('bayi'));
    }

    public function indexHistoryTambah(Request $request)
    {
        // var_dump($request->all());die();
        $bayi = DB::table('pasien_bayi')->where('no_registrasi', '=', $request->no_regnya)->get();
        $bayiArr = json_decode(json_encode($bayi), true);

        $konfirmasiJadwal = array();
        $konfirmasiJadwal[0]['tanggalnya'] = $request->tanggalnya;
        $konfirmasiJadwal[0]['id_layanannya'] = $request->id_layanannya;
        $konfirmasiJadwal[0]['no_regnya'] = $request->no_regnya;
        return view('layanan\imunisasiHistoryTambah', compact('bayiArr'), compact('konfirmasiJadwal'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hitungPengingat()
    {
        $hari_ini = DB::select("SELECT pb.id as idbayi,ijl.tanggal, l.nama as jenisImunisasi, pb.no_registrasi, pb.nama, pb.nama_ayah, pb.nama_ibu, pb.telp FROM imunisasi_jenis_layanan as ijl, layanan_imunisasi as li, pasien_bayi as pb, layanan as l WHERE ijl.id_layanan_imuniasasi = li.id AND li.no_registrasi = pb.no_registrasi AND ijl.id_jenis_layanan = l.id AND ijl.status_imunisasi = 0 AND pb.status_hapus=0 AND DATEDIFF(ijl.tanggal,'".date("Y-m-d")."')=0");

        $terlewati = DB::select("SELECT pb.id as idbayi,ijl.tanggal, l.nama as jenisImunisasi, pb.no_registrasi, pb.nama, pb.nama_ayah, pb.nama_ibu, pb.telp FROM imunisasi_jenis_layanan as ijl, layanan_imunisasi as li, pasien_bayi as pb, layanan as l WHERE ijl.id_layanan_imuniasasi = li.id AND li.no_registrasi = pb.no_registrasi AND ijl.id_jenis_layanan = l.id AND ijl.status_imunisasi = 0 AND pb.status_hapus=0 AND DATEDIFF(ijl.tanggal,'".date("Y-m-d")."')<0");

        $akan_datang = DB::select("SELECT pb.id as idbayi, ijl.tanggal, l.nama as jenisImunisasi, pb.no_registrasi, pb.nama, pb.nama_ayah, pb.nama_ibu, pb.telp FROM imunisasi_jenis_layanan as ijl, layanan_imunisasi as li, pasien_bayi as pb, layanan as l WHERE ijl.id_layanan_imuniasasi = li.id AND li.no_registrasi = pb.no_registrasi AND ijl.id_jenis_layanan = l.id AND ijl.status_imunisasi = 0 AND pb.status_hapus=0 AND (ijl.tanggal BETWEEN '".date("Y-m-d")."' AND '".date('Y-m-d', strtotime(date("Y-m-d"). ' +3 day'))."')");

        echo json_encode(array('hari_ini' => $hari_ini, 'terlewati' => $terlewati, 'akan_datang' => $akan_datang));
    }

     public function hitungTotalNotif()
    {
        $hari_ini = DB::select("SELECT pb.id as idbayi,ijl.tanggal, l.nama as jenisImunisasi, pb.no_registrasi, pb.nama, pb.nama_ayah, pb.nama_ibu, pb.telp FROM imunisasi_jenis_layanan as ijl, layanan_imunisasi as li, pasien_bayi as pb, layanan as l WHERE ijl.id_layanan_imuniasasi = li.id AND li.no_registrasi = pb.no_registrasi AND ijl.id_jenis_layanan = l.id AND ijl.status_imunisasi = 0 AND pb.status_hapus=0 AND DATEDIFF(ijl.tanggal,'".date("Y-m-d")."')=0");

        $terlewati = DB::select("SELECT pb.id as idbayi,ijl.tanggal, l.nama as jenisImunisasi, pb.no_registrasi, pb.nama, pb.nama_ayah, pb.nama_ibu, pb.telp FROM imunisasi_jenis_layanan as ijl, layanan_imunisasi as li, pasien_bayi as pb, layanan as l WHERE ijl.id_layanan_imuniasasi = li.id AND li.no_registrasi = pb.no_registrasi AND ijl.id_jenis_layanan = l.id AND ijl.status_imunisasi = 0 AND pb.status_hapus=0 AND DATEDIFF(ijl.tanggal,'".date("Y-m-d")."')<0");

        $akan_datang = DB::select("SELECT pb.id as idbayi, ijl.tanggal, l.nama as jenisImunisasi, pb.no_registrasi, pb.nama, pb.nama_ayah, pb.nama_ibu, pb.telp FROM imunisasi_jenis_layanan as ijl, layanan_imunisasi as li, pasien_bayi as pb, layanan as l WHERE ijl.id_layanan_imuniasasi = li.id AND li.no_registrasi = pb.no_registrasi AND ijl.id_jenis_layanan = l.id AND ijl.status_imunisasi = 0 AND pb.status_hapus=0 AND (ijl.tanggal BETWEEN '".date("Y-m-d")."' AND '".date('Y-m-d', strtotime(date("Y-m-d"). ' +3 day'))."')");
        $expired = DB::select("SELECT * FROM obat o WHERE o.status_hapus=0 AND (o.tanggal_kadaluarsa BETWEEN '".date("Y-m-d")."' AND '".date('Y-m-d', strtotime(date("Y-m-d"). ' +10 day'))."')");
        $stok = DB::select("SELECT * FROM obat o WHERE o.status_hapus=0 AND o.total_pcs<10");

        $total = count($hari_ini)+count($terlewati)+count($akan_datang)+count($expired)+count($stok);
        echo json_encode($total);
    }
    
}
