<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('master.home');
    }
    public function hitungPengingat()
    {
        $hari_ini = DB::select("SELECT pb.id as idbayi,ijl.tanggal, l.nama as jenisImunisasi, pb.id, pb.nama, pb.nama_ayah, pb.nama_ibu, pb.telp FROM imunisasi_jenis_layanan as ijl, layanan_imunisasi as li, pasien_bayi as pb, layanan as l WHERE ijl.id_layanan_imunisasi = li.id AND li.id_pasien_bayi = pb.id AND ijl.id_jenis_layanan = l.id AND ijl.status_imunisasi = 0 AND DATEDIFF(ijl.tanggal,'".date("Y-m-d")."')=0");

        $terlewati = DB::select("SELECT pb.id as idbayi,ijl.tanggal, l.nama as jenisImunisasi,  pb.id, pb.nama, pb.nama_ayah, pb.nama_ibu, pb.telp FROM imunisasi_jenis_layanan as ijl, layanan_imunisasi as li, pasien_bayi as pb, layanan as l WHERE ijl.id_layanan_imunisasi = li.id AND li.id_pasien_bayi = pb.id AND ijl.id_jenis_layanan = l.id AND ijl.status_imunisasi = 0 AND DATEDIFF(ijl.tanggal,'".date("Y-m-d")."')<0");

        $akan_datang = DB::select("SELECT pb.id as idbayi, ijl.tanggal, l.nama as jenisImunisasi,  pb.id, pb.nama, pb.nama_ayah, pb.nama_ibu, pb.telp FROM imunisasi_jenis_layanan as ijl, layanan_imunisasi as li, pasien_bayi as pb, layanan as l WHERE ijl.id_layanan_imunisasi = li.id AND li.id_pasien_bayi = pb.id AND ijl.id_jenis_layanan = l.id AND ijl.status_imunisasi = 0 AND (ijl.tanggal BETWEEN '".date("Y-m-d")."' AND '".date('Y-m-d', strtotime(date("Y-m-d"). ' +3 day'))."')");
        $expired = DB::select("SELECT * FROM obat o WHERE o.status_hapus=0 AND (o.tanggal_kadaluarsa BETWEEN '".date("Y-m-d")."' AND '".date('Y-m-d', strtotime(date("Y-m-d"). ' +10 day'))."')");
        $stok = DB::select("SELECT * FROM obat o WHERE o.status_hapus=0 AND o.total_pcs<10");

        echo json_encode(array('hari_ini' => $hari_ini, 'terlewati' => $terlewati, 'akan_datang' => $akan_datang, 'expired' => $expired, 'stok' => $stok));
    }

    public function hitungPerbandinganPendapatan()
    {
        $kb = DB::select("SELECT sum(total_harga) as total FROM transaksi WHERE jenis_layanan = '0' AND tanggal BETWEEN DATE_SUB(NOW() , INTERVAL 7 DAY) AND NOW()");
        $imunisasi_paketan = DB::select("SELECT sum(total_harga) as total FROM transaksi WHERE jenis_layanan = '1' AND tanggal BETWEEN DATE_SUB(NOW() , INTERVAL 7 DAY) AND NOW()");
        $imunisasi_satuan = DB::select("SELECT sum(total_harga) as total FROM transaksi WHERE jenis_layanan = '2' AND tanggal BETWEEN DATE_SUB(NOW() , INTERVAL 7 DAY) AND NOW()");
        $ibu_hamil = DB::select("SELECT sum(total_harga) as total FROM transaksi WHERE jenis_layanan = '3' AND tanggal BETWEEN DATE_SUB(NOW() , INTERVAL 7 DAY) AND NOW()");
        $klinik = DB::select("SELECT sum(total_harga) as total FROM transaksi WHERE jenis_layanan = 'KLINIK' AND tanggal BETWEEN DATE_SUB(NOW() , INTERVAL 7 DAY) AND NOW()");
        echo json_encode(array('klinik' => $klinik,'kb' => $kb, 'imunisasi_paketan' => $imunisasi_paketan, 'imunisasi_satuan' => $imunisasi_satuan, 'ibu_hamil' => $ibu_hamil));
    }

    public function totalPerHari()
    {
        $hari1 = DB::select("SELECT IF(sum(total_harga)>0, sum(total_harga), 0) as total, '".date('d M', strtotime("-1 days"))."' as tanggal FROM transaksi WHERE tanggal BETWEEN '".date('Y-m-d 00:00:00', strtotime("-1 days"))."' AND '".date('Y-m-d 23:59:59', strtotime("-1 days"))."'");
        $hari2 = DB::select("SELECT IF(sum(total_harga)>0, sum(total_harga), 0) as total, '".date('d M', strtotime("-2 days"))."' as tanggal FROM transaksi WHERE tanggal BETWEEN '".date('Y-m-d 00:00:00', strtotime("-2 days"))."' AND '".date('Y-m-d 23:59:59', strtotime("-2 days"))."'");
        $hari3 = DB::select("SELECT IF(sum(total_harga)>0, sum(total_harga), 0) as total, '".date('d M', strtotime("-3 days"))."' as tanggal FROM transaksi WHERE tanggal BETWEEN '".date('Y-m-d 00:00:00', strtotime("-3 days"))."' AND '".date('Y-m-d 23:59:59', strtotime("-3 days"))."'");
        $hari4 = DB::select("SELECT IF(sum(total_harga)>0, sum(total_harga), 0) as total, '".date('d M', strtotime("-4 days"))."' as tanggal FROM transaksi WHERE tanggal BETWEEN '".date('Y-m-d 00:00:00', strtotime("-4 days"))."' AND '".date('Y-m-d 23:59:59', strtotime("-4 days"))."'");
        $hari5 = DB::select("SELECT IF(sum(total_harga)>0, sum(total_harga), 0) as total, '".date('d M', strtotime("-5 days"))."' as tanggal FROM transaksi WHERE tanggal BETWEEN '".date('Y-m-d 00:00:00', strtotime("-5 days"))."' AND '".date('Y-m-d 23:59:59', strtotime("-5 days"))."'");
        $hari6 = DB::select("SELECT IF(sum(total_harga)>0, sum(total_harga), 0) as total, '".date('d M', strtotime("-6 days"))."' as tanggal FROM transaksi WHERE tanggal BETWEEN '".date('Y-m-d 00:00:00', strtotime("-6 days"))."' AND '".date('Y-m-d 23:59:59', strtotime("-6 days"))."'");
        $hari7 = DB::select("SELECT IF(sum(total_harga)>0, sum(total_harga), 0) as total, '".date('d M', strtotime("-7 days"))."' as tanggal FROM transaksi WHERE tanggal BETWEEN '".date('Y-m-d 00:00:00', strtotime("-7 days"))."' AND '".date('Y-m-d 23:59:59', strtotime("-7 days"))."'");
        echo json_encode(array('hari1' => $hari1,'hari2' => $hari2,'hari3' => $hari3,'hari4' => $hari4,'hari5' => $hari5,'hari6' => $hari6,'hari7' => $hari7));
    }
}
