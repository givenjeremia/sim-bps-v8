<?php

namespace App\Http\Controllers;

use App\Models\master\PasienBayi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class PasienBayiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bayi = PasienBayi::where('status_hapus', '=', 0)->orderBy('id', 'desc')->get();
        $bayiArr = json_decode(json_encode($bayi), true);
        return view('master.bayi', compact('bayiArr'));
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
        $nama = $request->txtNama;
        $tgl_lahir = date("Y-m-d", strtotime($request->dtpTanggalLahir));
        $bbl = $request->txtBBL;
        $cara_persalinan = $request->cbxCaraPersalinan;
        $alamat = $request->txtAlamat;
        $nama_ayah = $request->txtNamaAyah;
        $nama_ibu = $request->txtNamaIbu;
        $telp = $request->txtTelp;
        $kelurahan = $request->txtKelurahan;
        $asal_wilayah = $request->txtAsalWilayah;
        $kelamin = $request->cbxKelamin;

        $created_by = Auth::user()->id;
        $created_at = Carbon::now();
        $updated_by = Auth::user()->id;
        $updated_at = Carbon::now();
        $validation = new PasienBayi();
        $validation = $validation->validator($request->all(), 'tambah');
        if ($validation->fails()) {
            return redirect()->back()->with(['notif_gagal' => 'Data pasien gagal disimpan.']);
        } else {
            $new = new PasienBayi();
            $new->nama = $nama;
            $new->kelamin = $kelamin;
            $new->tanggal_lahir = $tgl_lahir;
            $new->bbl = $bbl;
            $new->cara_persalinan = $cara_persalinan;
            $new->kelurahan = $kelurahan;
            $new->asal_wilayah = $asal_wilayah;
            $new->alamat = $alamat;
            $new->nama_ayah = $nama_ayah;
            $new->nama_ibu = $nama_ibu;
            $new->telp = $telp;
            $new->status_hapus = 0;
            $new->created_at = $created_at;
            $new->created_by = $created_by;
            $new->updated_at = $updated_at;
            $new->updated_by = $updated_by;
            $new->save();

            $id = $new->id;

            // Update
            $new->no_registrasi = 'AB' . Carbon::now()->format('Ymd') . $id;
            $new->updated_at = Carbon::now();
            $new->updated_by = Auth::user()->id;
            $new->save();

            return redirect()->back()->with('notif_berhasil', 'Pasien berhasil ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PasienBayi  $pasienBayi
     * @return \Illuminate\Http\Response
     */
    public function show(PasienBayi $pasienBayi)
    {
        //
        echo json_encode($pasienBayi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PasienBayi  $pasienBayi
     * @return \Illuminate\Http\Response
     */
    public function edit(PasienBayi $pasienBayi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PasienBayi  $pasienBayi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PasienBayi $pasienBayi)
    {
        //
        $updated_by = Auth::user()->id;
        $updated_at = Carbon::now();

        $validation = $this->validator($request->all(), 'edit');
        if ($validation->fails()) {
            return redirect()->back()->with(['notif_gagal' => 'Data pasien gagal dirubah.']);
        } else {
            $id = $request->input('txtIdEdit');
            $pasienBayi->nama = $request->input('txtNamaEdit');
            $pasienBayi->tanggal_lahir = date("Y-m-d", strtotime($request->input('txtTTLEdit')));
            $pasienBayi->bbl = $request->input('txtBBLEdit');
            $pasienBayi->cara_persalinan = $request->input('cbxCaraPersalinanEdit');
            $pasienBayi->kelurahan = $request->input('txtKelurahanEdit');
            $pasienBayi->asal_wilayah = $request->input('txtAsalWilayahEdit');
            $pasienBayi->alamat = $request->input('txtAlamatEdit');
            $pasienBayi->nama_ayah = $request->input('txtNamaAyahEdit');
            $pasienBayi->nama_ibu = $request->input('txtNamaIbuEdit');
            $pasienBayi->telp = $request->input('txtTelpEdit');
            $pasienBayi->updated_at = $updated_at;
            $pasienBayi->updated_by = $updated_by;
            $pasienBayi->save();

            return redirect()->back()->with(['notif_berhasil' => 'Data pasien berhasil dirubah.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PasienBayi  $pasienBayi
     * @return \Illuminate\Http\Response
     */
    public function destroy(PasienBayi $pasienBayi)
    {
        //
        $pasienBayi->status_hapus = 1;
        $pasienBayi->updated_at = Carbon::now();
        $pasienBayi->updated_by = Auth::user()->id;
        $pasienBayi->save();

        return redirect()->back()->with(['notif_berhasil' => 'Data pasien berhasil dihapus.']);
    }

    public function destroyChecked(Request $request)
    {   
        $id = $request->input('txtIdHapusTerpilih');
        $arrId = explode(',', $id);
        foreach ($arrId as $key => $value) {
            $pasienBayi = PasienBayi::find($value);
            $pasienBayi->status_hapus = 1;
            $pasienBayi->updated_at = Carbon::now();
            $pasienBayi->updated_by = Auth::user()->id;
            $pasienBayi->save();
        }

        return redirect()->back()->with(['notif_berhasil'=>'Data pasien berhasil dihapus.']);
    }

    public function detail(Request $request)
    {
        $id_bayi = $request->input('bayi_id');

        $bayi = PasienBayi::find($id_bayi);
        $bayiArr = array();
        foreach ($bayi as $key => $value) {
            $bayiArr['id'] = $value->id;
            $bayiArr['nama'] = $value->nama;
            $bayiArr['kelamin'] = $value->kelamin;
            $bayiArr['tanggal_lahir'] = date("d-m-Y", strtotime($value->tanggal_lahir));
            $bayiArr['bbl'] = $value->bbl;
            $bayiArr['cara_persalinan'] = $value->cara_persalinan;
            $bayiArr['kelurahan'] = $value->kelurahan;
            $bayiArr['asal_wilayah'] = $value->asal_wilayah;
            $bayiArr['alamat'] = $value->alamat;
            $bayiArr['nama_ayah'] = $value->nama_ayah;
            $bayiArr['nama_ibu'] = $value->nama_ibu;
            $bayiArr['telp'] = $value->telp;
            $bayiArr['status_hapus'] = $value->status_hapus;
            $bayiArr['no_registrasi'] = $value->no_registrasi;
        }

        echo json_encode($bayiArr);
    }

    public function exportTemplate()
    {
        Excel::create('template_pasien_bayi', function ($excel) {
            // Set the title
            $excel->setTitle('Template Data Master Pasien Bayi');
            $excel->sheet('sheet1', function ($sheet) {
                $data = array(
                    array('id', 'nama', 'kelamin', 'tanggal_lahir', 'bbl', 'cara_persalinan', 'kelurahan', 'asal_wilayah', 'alamat', 'nama_ayah', 'nama_ibu', 'telp', 'Cara persalinan 0=Normal, 1=Caesar'),
                    array('1', 'Zohri', 'L', '1997-01-01', '3.2', '0', 'Rungkut', 'Surabaya', 'Jl. Kertajaya Indah Timur IX No. 1 Surabaya', 'Suparto', 'Harini', '087761525167', 'Jenis Kelamin L=Laki-laki P=Perempuan'),
                    array('2', 'Mc Gregor', 'P', '1997-05-12', '3.3', '1', 'Gunungsari', 'Sidoarjo', 'Jl. Margomulyo Timur No. 19 Surabaya', 'Mahmud A', 'Surti Mahmudah', '087666789124'),
                );
                $sheet->fromArray($data, null, 'A1', false, false);
                $sheet->cells('A1:L1', function ($cells) {
                    $cells->setBackground('#AAAAFF');
                });
            });
        })->download('xlsx');
    }

    public function importKaryawan(Request $request)
    {
        if ($request->hasFile('input-file-now')) {
            $path = $request->file('input-file-now')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();
            if (!empty($data) && $data->count()) {
                foreach ($data as $key => $value) {
                    $created_by = Auth::user()->id;
                    $created_at = Carbon::now();
                    $updated_by = Auth::user()->id;
                    $updated_at = Carbon::now();

                    $new = new PasienBayi();
                    $new->nama = $value->nama;
                    $new->kelamin = $value->kelamin;
                    $new->tanggal_lahir = date("Y-m-d", strtotime($value->tanggal_lahir));
                    $new->bbl = $value->bbl;
                    $new->cara_persalinan = $value->cara_persalinan;
                    $new->kelurahan = $value->kelurahan;
                    $new->asal_wilayah = $value->asal_wilayah;
                    $new->alamat = $value->alamat;
                    $new->nama_ayah = $value->nama_ayah;
                    $new->nama_ibu = $value->nama_ibu;
                    $new->telp = $value->telp;
                    $new->status_hapus = 0;
                    $new->created_at = $created_at;
                    $new->created_by = $created_by;
                    $new->updated_at = $updated_at;
                    $new->updated_by = $updated_by;
                    $new->save();

                    $id = $new->id;

                    // Update
                    $new->no_registrasi = 'AB' . Carbon::now()->format('Ymd') . $id;
                    $new->updated_at = Carbon::now();
                    $new->updated_by = Auth::user()->id;
                    $new->save();
                }

                return redirect()->back()->with(['notif_berhasil' => 'Data pasien bayi berhasil disimpan']);
            } else {
                return redirect()->back()->with(['notif_gagal' => 'Data import kosong']);
            }
        }
    }

    public function cetakKartu($id)
    {
        $bayi = PasienBayi::find($id)->where('status_hapus',0)->get();

        $pdf = Pdf::loadView(
            'master.cetak_kartu', 
            [
                'bayi' => $bayi
            ]
        );
        return $pdf->stream('kartu.pdf');
    }

}
