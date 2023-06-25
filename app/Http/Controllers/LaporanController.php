<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{

    public function indexLaporanKeuangan()
    {
        // $laporan = DB::table("transaksi")->where('tanggal','>=', date_format($request->tanggal_bawah,"Y-m-d 00:00:00"))->where('tanggal','<=', date_format($request->tanggal_atas,"Y-m-d 23:59:59"))->get();
        $datenow = date("Y-m");
        $laporan = Transaksi::whereRaw('DATE_FORMAT(tanggal, "%Y-%m") = ?', [$datenow])->get();
        $total_keuntungan = 0;
        $total_obat = 0;
        $total_totharga = 0;
        foreach ($laporan as $key => $value) {
            $total_keuntungan += $value->harga_layanan;
            $total_obat += $value->harga_obat;
            $total_totharga += $value->total_harga;
        }

        return view('laporan.keuangan', compact(["laporan", "total_keuntungan", "total_obat", "total_totharga"]));
    }

    public function indexLaporanKeuanganFilter(Request $request)
    {
        $tanggal = explode(" - ",$request->filter_date);
        $tanggal_bawah_explode = explode("/",$tanggal[0]);
        $tanggal_bawah = $tanggal_bawah_explode[2]."-".$tanggal_bawah_explode[0]."-".$tanggal_bawah_explode[1];
        $tanggal_atas_explode = explode("/",$tanggal[1]);
        $tanggal_atas = $tanggal_atas_explode[2]."-".$tanggal_atas_explode[0]."-".$tanggal_atas_explode[1];
        
        $laporan = DB::table("transaksi")->where('tanggal','>=', $tanggal_bawah." 00:00:00")->where('tanggal','<=', $tanggal_atas." 23:59:59")->get();

        $total_keuntungan = 0;
        $total_obat = 0;
        $total_totharga = 0;
        foreach ($laporan as $key => $value) {
            $total_keuntungan += $value->harga_layanan;
            $total_obat += $value->harga_obat;
            $total_totharga += $value->total_harga;
        }

        return view('laporan.keuangan', compact(["laporan", "total_keuntungan", "total_obat", "total_totharga"]));
        // return $tanggal;
    }

    public function printLaporanKeuangan(Request $request)
    {
        $tanggal = explode(" - ",$request->tanggal);
        $tanggal_bawah_explode = explode("/",$tanggal[0]);
        $tanggal_bawah = $tanggal_bawah_explode[2]."-".$tanggal_bawah_explode[0]."-".$tanggal_bawah_explode[1];
        $tanggal_atas_explode = explode("/",$tanggal[1]);
        $tanggal_atas = $tanggal_atas_explode[2]."-".$tanggal_atas_explode[0]."-".$tanggal_atas_explode[1];
        
        $laporan = DB::table("transaksi")->where('tanggal','>=', $tanggal_bawah." 00:00:00")->where('tanggal','<=', $tanggal_atas." 23:59:59")->get();

        $total_keuntungan = 0;
        $total_obat = 0;
        $total_totharga = 0;
        foreach ($laporan as $key => $value) {
            $total_keuntungan += $value->harga_layanan;
            $total_obat += $value->harga_obat;
            $total_totharga += $value->total_harga;
        }

        $judul = 'Laporan Keuntungan BPM. Lita Anggraeni Amd. Keb'."<BR>".'Periode '.date("d-m-Y", strtotime($tanggal_bawah)).' - '.date("d-m-Y", strtotime($tanggal_atas));

        $dompdf = new Dompdf();
        $dompdf->loadHtml(View::make('laporan.print.laporan_keuangan',[
            'laporan' => $laporan, 
            'judul' => $judul,
            'total_keuntungan' => $total_keuntungan, 
            'total_obat' => $total_obat,
            'total_totharga' => $total_totharga
        ] )->render());
        $dompdf->render();
        $title = $judul;
        return $dompdf->stream($title, ['Attachment' => false]);
    }

    // Ibu Hamil
    
    public function indexLaporanKunjunganIbuHamil()
    {
        $laporan = DB::table("transaksi")->get();

        return view('laporan.kunjungan_ibu_hamil', compact(["laporan"]));
    }

    public function printLaporanKunjunganIbuHamil(Request $request)
    {
        $tanggal = explode(" - ",$request->tanggal);
        $tanggal_bawah_explode = explode("/",$tanggal[0]);
        $tanggal_bawah = $tanggal_bawah_explode[2]."-".$tanggal_bawah_explode[0]."-".$tanggal_bawah_explode[1];
        $tanggal_atas_explode = explode("/",$tanggal[1]);
        $tanggal_atas = $tanggal_atas_explode[2]."-".$tanggal_atas_explode[0]."-".$tanggal_atas_explode[1];
        
        $puskesmas = DB::table("kepala_puskesmas")->where('status_aktif','=', 1)->get();

        $laporan = DB::table("layanan_ibu_hamil")->where('tanggal','>=', $tanggal_bawah." 00:00:00")->where('tanggal','<=', $tanggal_atas." 23:59:59")->get();

        $judul = 'Laporan Kunjungan Ibu Hamil BPM. Lita Anggraeni Amd. Keb'."<BR>".'Periode '.date("d-m-Y", strtotime($tanggal_bawah)).' - '.date("d-m-Y", strtotime($tanggal_atas));

        $dompdf = new Dompdf();
        $dompdf->loadHtml(View::make('laporan.print.kunjungan_ibu_hamil', 
        [
            'kepala_puskesmas' => $puskesmas,
            'laporan' => $laporan, 
            'judul' => $judul,
            'tgl_awal' => $tanggal_bawah
        ],
        [],
        [
            'orientation' => 'L'
        ] )->render());
        $dompdf->render();
        $title = $judul;
        return $dompdf->stream($title, ['Attachment' => false]);
    }

    // Kunjungan Bersalin
    public function indexLaporanKunjunganPersalinan()
    {
        $laporan = DB::table("transaksi")->get();
        return view('laporan.kunjungan_persalinan', compact(["laporan"]));
    }

    public function printLaporanKunjunganPersalinan(Request $request)
    {
        $tanggal = explode(" - ",$request->tanggal);
        $tanggal_bawah_explode = explode("/",$tanggal[0]);
        $tanggal_bawah = $tanggal_bawah_explode[2]."-".$tanggal_bawah_explode[0]."-".$tanggal_bawah_explode[1];
        $tanggal_atas_explode = explode("/",$tanggal[1]);
        $tanggal_atas = $tanggal_atas_explode[2]."-".$tanggal_atas_explode[0]."-".$tanggal_atas_explode[1];
        
        $puskesmas = DB::table("kepala_puskesmas")->where('status_aktif','=', 1)->get();

        $laporan = DB::table("catatan_persalinan")->where('tanggal','>=', $tanggal_bawah." 00:00:00")->where('tanggal','<=', $tanggal_atas." 23:59:59")->get();

        $judul = 'Laporan Kunjungan Persalinan BPM. Lita Anggraeni Amd. Keb'."<BR>".'Periode '.date("d-m-Y", strtotime($tanggal_bawah)).' - '.date("d-m-Y", strtotime($tanggal_atas));


        $dompdf = new Dompdf();
        $dompdf->loadHtml(View::make('laporan.print.kunjungan_persalinan', 
        [   
            'kepala_puskesmas' => $puskesmas,
            'laporan' => $laporan, 
            'judul' => $judul,
            'tgl_awal' => $tanggal_bawah
        ] )->render());
        $dompdf->render();
        $title = $judul;
        return $dompdf->stream($title, ['Attachment' => false]);
    }

    // Kunjungan KB
    public function indexLaporanKunjunganKB()
    {
        $laporan = DB::table("transaksi")->get();
        return view('laporan.kunjungan_kb', compact(["laporan"]));
    }

    public function printLaporanKunjunganKB(Request $request)
    {
        $tanggal = explode(" - ",$request->tanggal);
        $tanggal_bawah_explode = explode("/",$tanggal[0]);
        $tanggal_bawah = $tanggal_bawah_explode[2]."-".$tanggal_bawah_explode[0]."-".$tanggal_bawah_explode[1];
        $tanggal_atas_explode = explode("/",$tanggal[1]);
        $tanggal_atas = $tanggal_atas_explode[2]."-".$tanggal_atas_explode[0]."-".$tanggal_atas_explode[1];
        
        $laporan = DB::table("layanan_kb")->where('tgl_status_peserta','>=', $tanggal_bawah." 00:00:00")->where('tgl_status_peserta','<=', $tanggal_atas." 23:59:59")->get();

        $judul = 'Laporan Kunjungan KB BPM. Lita Anggraeni Amd. Keb'."<BR>".'Periode '.date("d-m-Y", strtotime($tanggal_bawah)).' - '.date("d-m-Y", strtotime($tanggal_atas));

        $dompdf = new Dompdf();
        $dompdf->loadHtml(View::make('laporan.print.kunjungan_kb', 
        [
            'laporan' => $laporan, 
            'judul' => $judul
        ],
        [],
        [
            'orientation' => 'L'
        ])->render());
        $dompdf->render();
        $title = $judul;
        return $dompdf->stream($title, ['Attachment' => false]);
    }


    public function indexLaporanImunisasi()
    {
        $laporan = DB::table("transaksi")->get();

        return view('laporan.hasil_imunisasi', compact(["laporan"]));
    }

    public function printLaporanImunisasi(Request $request)
    {
        $tanggal = explode(" - ",$request->tanggal);
        $tanggal_bawah_explode = explode("/",$tanggal[0]);
        $tanggal_bawah = $tanggal_bawah_explode[2]."-".$tanggal_bawah_explode[0]."-".$tanggal_bawah_explode[1];
        $tanggal_atas_explode = explode("/",$tanggal[1]);
        $tanggal_atas = $tanggal_atas_explode[2]."-".$tanggal_atas_explode[0]."-".$tanggal_atas_explode[1];
        
        $laporan = DB::table("transaksi")->where('tanggal','>=', $tanggal_bawah." 00:00:00")->where('tanggal','<=', $tanggal_atas." 23:59:59")->get();
        $pasien_bayi = DB::table("pasien_bayi")->join('layanan_imunisasi', 'layanan_imunisasi.no_registrasi','=', 'pasien_bayi.no_registrasi')->where('status_hapus','=','0')->get();
        $puskesmas = DB::table("kepala_puskesmas")->where('status_aktif','=', 1)->get();
        $header_layanan_imunisasi = DB::select("SELECT * FROM layanan WHERE status_hapus=0 AND (pelayanan=1 OR pelayanan=2) ORDER BY pelayanan DESC");
        $imunisasi_jenis_layanan = DB::select("SELECT li.no_registrasi, ijl.* FROM  layanan_imunisasi li, imunisasi_jenis_layanan ijl WHERE li.id = ijl.id_layanan_imuniasasi AND ijl.tanggal>='".$tanggal_bawah." 00:00:00' AND ijl.tanggal<='".$tanggal_atas." 23:59:59'");

        $total_keuntungan = 0;
        foreach ($laporan as $key => $value) {
            $total_keuntungan += $value->harga_layanan;
        }

        $judul = 'HASIL IMUNISASI PUSKESMAS, RS, RB, BKIA, DOKTER, BIDAN SWASTA'."<BR>".'BPM. Lita Anggraeni Amd. Keb'."<BR>".'PERIODE '.date("d-m-Y", strtotime($tanggal_bawah)).' - '.date("d-m-Y", strtotime($tanggal_atas));
        $dompdf = new Dompdf();
        $dompdf->loadHtml(View::make('laporan.print_laporan_imunisasi', 
        [
            'judul' => $judul,
            'pasien_bayi' => $pasien_bayi,
            'puskesmas' => $puskesmas,
            'header_layanan_imunisasi' => $header_layanan_imunisasi,
            'imunisasi_jenis_layanan' => $imunisasi_jenis_layanan,
            'tanggal_atas' => $tanggal_atas,
            'tanggal_bawah' => $tanggal_bawah
        ],
        [],
        [
            'orientation' => 'L'
        ])->render());
        $dompdf->render();
        $title = $judul;
        return $dompdf->stream($title, ['Attachment' => false]);
    }


    public function exportLaporanKunjunganKBe(Request $request) {

        $tanggal = explode(" - ",$request->tanggal);
        $tanggal_bawah_explode = explode("/",$tanggal[0]);
        $tanggal_bawah = $tanggal_bawah_explode[2]."-".$tanggal_bawah_explode[0]."-".$tanggal_bawah_explode[1];
        $tanggal_atas_explode = explode("/",$tanggal[1]);
        $tanggal_atas = $tanggal_atas_explode[2]."-".$tanggal_atas_explode[0]."-".$tanggal_atas_explode[1];
        
        //$laporan = DB::table("layanan_kb")->where('tgl_status_peserta','>=', $tanggal_bawah." 00:00:00")->where('tgl_status_peserta','<=', $tanggal_atas." 23:59:59")->get();

        $laporan = DB::select("
            SELECT DISTINCT lk.jumlah_anak_laki, lk.jumlah_anak_perempuan, hkb.tgl as tgl_dilayani, l.nama AS 'nama_layanan', pd.nama AS nama_ibu, spd.nama AS nama_ayah, pd.tanggal_lahir AS tanggal_lahir_ibu, pd.alamat AS alamat_ibu
            FROM layanan_kb lk
            LEFT JOIN history_kb hkb ON hkb.id_layanan_kb = lk.id
            LEFT JOIN pasien_dewasa pd ON pd.`no_registrasi` = lk.`no_registrasi_pasien`
            LEFT JOIN suami_pasien_dewasa spd ON spd.`id_pasien_dewasa`=pd.`id`
            INNER JOIN layanan l ON l.id = hkb.id_jenis_layanan
            WHERE pd.status_hapus=0
            AND hkb.tgl >= '".$tanggal_bawah." 00:00:00'
            AND hkb.tgl <= '".$tanggal_atas." 23:59:59'
            UNION
            SELECT DISTINCT lk.jumlah_anak_laki, lk.jumlah_anak_perempuan, lk.tgl_dilayani as tgl_dilayani, l.nama AS 'nama_layanan', pd.nama AS nama_ibu, spd.nama AS nama_ayah, pd.tanggal_lahir AS tanggal_lahir_ibu, pd.alamat AS alamat_ibu
            FROM layanan_kb lk
            LEFT JOIN pasien_dewasa pd ON pd.`no_registrasi` = lk.`no_registrasi_pasien`
            LEFT JOIN suami_pasien_dewasa spd ON spd.`id_pasien_dewasa`=pd.`id`
            INNER JOIN layanan l ON l.id = lk.id_jenis_layanan
            WHERE pd.status_hapus=0
            AND lk.tgl_dilayani >= '".$tanggal_bawah." 00:00:00'
            AND lk.tgl_dilayani <= '".$tanggal_atas." 23:59:59'"
        );

        
        // print_r(json_decode(json_encode($laporan));
        // die();
        

        $judul = 'Laporan Kunjungan KB BPM. Lita Anggraeni Amd. Keb';
        $judul2 ='Periode '.date("d-m-Y", strtotime($tanggal_bawah)).' - '.date("d-m-Y", strtotime($tanggal_atas));

        


        
        Excel::create('laporanKB', function($excel) use ($laporan, $judul, $judul2) {
            // Set the title
            $excel->setTitle('Laporan KB');
            // $excel->setCreator('no no creator')->setCompany('no company');
            // $excel->setDescription('report file');
            $excel->sheet('sheet1', function($sheet) use ($laporan, $judul, $judul2) {

                $kolomnya = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U');

                foreach ($kolomnya as $key => $value) {
                    # code...
                    $sheet->cells($value.'3:'.$value.'3', function($cells) {
                        $cells->setBorder('thin', 'thin', 'thin', 'thin');
                    });
                }
                foreach ($kolomnya as $key => $value) {
                    # code...
                    $sheet->cells($value.'4:'.$value.'4', function($cells) {
                        $cells->setBorder('thin', 'thin', 'thin', 'thin');
                    });
                }
                $rowMengetahui = 7;
                foreach ($laporan as $key2 => $value2) {
                    # code...
                    foreach ($kolomnya as $key => $value) {
                    # code...
                        $sheet->cells($value.($key2+5).':'.$value.($key2+5), function($cells) {
                            $cells->setBorder('thin', 'thin', 'thin', 'thin');
                        });
                    }
                    $rowMengetahui = $key2+5+3;
                }
                

                $sheet->setWidth(array(
                    'A'     =>  5,
                    'B'     =>  10,
                    'C'     =>  10,
                    'D'     =>  10,
                    'E'     =>  10,
                    'F'     =>  10,
                    'G'     =>  5,
                    'H'     =>  5,
                    'I'     =>  10,
                    'J'     =>  10,
                    'K'     =>  10,
                    'L'     =>  10,
                    'M'     =>  10,
                    'N'     =>  10,
                    'O'     =>  10,
                    'P'     =>  15,
                    'Q'     =>  10,
                    'R'     =>  15,
                    'S'     =>  10,
                    'T'     =>  10
                ));

                $mergenkolomnya = array('A','B','E','F','I','J','K','L','M','P','Q','R','S','T','U');
                foreach ($mergenkolomnya as $key => $value) {
                    # code...
                    $sheet->setMergeColumn(array(
                        'columns' => array($value),
                        'rows' => array(
                            array(3,4)
                        )
                    ));
                }

                $data = array(
                    array($judul),
                    array($judul2),
                    array('No','Tgl Kunjung','Nama','','Umur','Alamat','Status KB','','JML Anak','Gakin non Gakin','Jenis KB Alkon','Penyakit Kronis','Pus 4T','Pasca/Setelah','','Lila < 23CM','Pus Anemia','IMS/Penyakit Kelamin','Efek Samping','Kegagalan','DO'),
                    array('','','Ibu','Ayah','','','B','L','','','','','','Lahir','Abortus','','','','','','')
                );

                foreach ($laporan as $key => $value) {
                    # code...
                    
                    array_push($data, 
                        array($key+1,date('d-m-Y', strtotime($value->tgl_dilayani)),$value->nama_ibu,$value->nama_ayah,floor((time() - strtotime($value->tanggal_lahir_ibu)) / 31556926),$value->alamat_ibu,'','',$value->jumlah_anak_laki+$value->jumlah_anak_perempuan,'',$value->nama_layanan,'','','','','','','','')
                    );
                }

                //mengetahui dan membuat laporan
                for ($i=0; $i < 2; $i++) { 
                    # code...
                    array_push($data, 
                        array('','','','','','','','','','','','','','','','','','','','')
                    );
                }
                array_push($data, 
                    array('','','','','','','','','','','','','','','Mengetahui','','','','','')
                );
                $kepala_puskesmas = DB::table('kepala_puskesmas')->where('status_aktif',1)->get();
                array_push($data, 
                    array('','','','','','','','','','','','','','','Kepala Puskesmas '.$kepala_puskesmas[0]->kelurahan,'','','Yang Membuat Laporan','','')
                );
                for ($i=0; $i < 4; $i++) { 
                    # code...
                    array_push($data, 
                        array('','','','','','','','','','','','','','','','','','','','')
                    );
                }
                array_push($data, 
                    array('','','','','','','','','','','','','','',$kepala_puskesmas[0]->nama,'','','Dsk. P. Lita Anggraeni, A.Md.Keb','','')
                );
                array_push($data, 
                    array('','','','','','','','','','','','','','',$kepala_puskesmas[0]->nip,'','','','','')
                );


                $sheet->fromArray($data, null, 'A1', false, false);


                $sheet->mergeCells('A1:T1'); //judul
                $wrapKolom = array('B','G','H','I','J','K','L','M','P','Q','R','S');
                foreach ($wrapKolom as $key => $value) {
                    # code...
                    $sheet->getStyle($value.'3:'.$value.'4')->getAlignment()->setWrapText(true);
                }

                $sheet->cells('A1:T1', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->mergeCells('A2:T2'); //judul2
                $sheet->cells('A2:T2', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->mergeCells('C3:D3'); //Nama 
                $sheet->cells('C3:D3', function($cells) {
                    $cells->setAlignment('center');
                });               
                $sheet->mergeCells('G3:H3'); //Jenis
                $sheet->cells('G3:H3', function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->mergeCells('N3:O3'); //Jenis
                $sheet->cells('N3:O3', function($cells) {
                    $cells->setAlignment('center');
                });


                //merge cell mengetahui
                $sheet->mergeCells('O'.$rowMengetahui.':P'.$rowMengetahui); 
                $sheet->cells('O'.$rowMengetahui.':P'.$rowMengetahui, function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->mergeCells('O'.($rowMengetahui+1).':P'.($rowMengetahui+1)); 
                $sheet->cells('O'.($rowMengetahui+1).':P'.($rowMengetahui+1), function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->mergeCells('O'.($rowMengetahui+6).':P'.($rowMengetahui+6)); 
                $sheet->cells('O'.($rowMengetahui+6).':P'.($rowMengetahui+6), function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->mergeCells('O'.($rowMengetahui+7).':P'.($rowMengetahui+7)); 
                $sheet->cells('O'.($rowMengetahui+7).':P'.($rowMengetahui+7), function($cells) {
                    $cells->setAlignment('center');
                });


                $sheet->mergeCells('R'.($rowMengetahui+1).':S'.($rowMengetahui+1)); 
                $sheet->cells('R'.($rowMengetahui+1).':S'.($rowMengetahui+1), function($cells) {
                    $cells->setAlignment('center');
                });
                $sheet->mergeCells('R'.($rowMengetahui+6).':S'.($rowMengetahui+6)); 
                $sheet->cells('R'.($rowMengetahui+6).':S'.($rowMengetahui+6), function($cells) {
                    $cells->setAlignment('center');
                });




                // $sheet->cells('A1:i1', function($cells) {
                //     $cells->setBackground('#AAAAFF');
                // });
            });
        })->download('xlsx');
        

    }
}
