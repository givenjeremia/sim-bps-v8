<?php

namespace App\Http\Controllers\master;

use Carbon\Carbon;
use App\Models\master\Obat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\master\JenisLayanan;
use Illuminate\Support\Facades\Auth;

class JenisLayananController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $layanan = JenisLayanan::where('status_hapus', '=', 0)->orderBy('id', 'desc')->get();
        return view('master.layanan.jenisLayanan', compact('layanan'));
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
        $id_obat = $request->input('txtIdObat');
        $qty = $request->input('txtQtyObat');
        $pelayanan = $request->input('txtPelayanan');
        $nama_layanan = $request->input('txtNamaLayanan');
        $tarif_layanan = (float)str_replace(',', '', $request->input('txtTarifLayanan'));
        $total_layanan = 0;
        $validation = new JenisLayanan();
        $validation = $validation->validator($request->all(), 'tambah');
        if ($validation->fails()) {
            return redirect()->back()->with(['notif_gagal' => 'Data jenis layanan gagal disimpan.']);
        } else {
            $new = new JenisLayanan();
            $new->pelayanan = $pelayanan;
            $new->nama = $nama_layanan;
            $new->tarif_layanan = $tarif_layanan;
            $new->tarif_total = $total_layanan;
            $new->users_id = 4;
            $new->status_hapus = 0;
      
            $new->save();
            $id_new = $new->id;
            $total_layanan  = $new->tarif_layanan;
            
            $arrIdObat = explode(',', $id_obat);
            $arrQty = explode(',', $qty);
            if ($id_obat != "") {
                foreach ($arrIdObat as $key => $value) {
                    $obat = Obat::find($value);
                    $sub_total =  $obat->harga * $arrQty[$key];
                    $total_layanan += $sub_total;
                    $new->obat()->attach($value, ['qty' => $arrQty[$key], 'subtotal' => $sub_total]);
                }
                $update = JenisLayanan::find($id_new);
                $update->tarif_total = $total_layanan;
                $update->save();
                return redirect()->back()->with('notif_berhasil', 'Data jenis layanan berhasil ditambahkan');
            } else {
                $update = JenisLayanan::find($id_new);
                $update->tarif_total = $total_layanan;
                $update->save();
                return redirect()->back()->with('notif_berhasil', 'Data jenis layanan berhasil ditambahkan');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisLayanan  $jenisLayanan
     * @return \Illuminate\Http\Response
     */
    public function show($jenisLayanan)
    {
        $value = JenisLayanan::find($jenisLayanan);
        $layananArr = array();
        $layananArr['id'] = $value->id;
        $layananArr['nama'] = $value->nama;
        $layananArr['pelayanan'] = $value->pelayanan;
        $layananArr['tarif_total'] = $value->tarif_total;
        $layananArr['tarif_layanan'] = $value->tarif_layanan;
        $obat = DB::table('layanan')->leftJoin('obat_layanan', 'layanan.id', '=', 'obat_layanan.id_layanan')->leftJoin('obat', 'obat_layanan.id_obat', '=', 'obat.id')->where('layanan.id', '=', $value->id)->get();
        $layananArr['obat'] = $obat;
        echo json_encode($layananArr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisLayanan  $jenisLayanan
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisLayanan $jenisLayanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisLayanan  $jenisLayanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisLayanan $jenisLayanan)
    {
        $id_layanan = $request->input('txtIdEdit');
        $id_obat = $request->input('txtIdObatEdit');
        $qty = $request->input('txtQtyObatEdit');
        $nama_layanan = $request->input('txtNamaLayananEdit');
        $tarif_layanan = (float)str_replace(',', '', $request->input('txtTarifLayananEdit'));
        $total_layanan = $tarif_layanan;
        $arrIdObat = explode(',', $id_obat);
        $arrQty = explode(',', $qty);
        if ($id_obat != "") {
            foreach ($arrIdObat as $key => $value) {
                $obat = Obat::find($value);
                // Hapus Layanan
                $obat->layanan()->detach($id_layanan);
                // Tambah Layanan
                $sub_total =  $obat->harga * $arrQty[$key];
                $total_layanan += $sub_total;
                $obat->layanan()->attach($id_layanan, ['qty' => $arrQty[$key], 'subtotal' => $sub_total]);
            }

            $layanan = JenisLayanan::find($id_layanan);
            $layanan->tarif_layanan = $tarif_layanan;
            $layanan->tarif_total = $total_layanan;
            $layanan->nama = $nama_layanan;
            $layanan->save();
            return redirect()->back()->with('notif_berhasil', 'Data jenis layanan berhasil dirubah');
        } else {
            $layanan = JenisLayanan::find($id_layanan);
            $layanan->tarif_layanan = $tarif_layanan;
            $layanan->tarif_total = $tarif_layanan;
            $layanan->nama = $nama_layanan;
            $layanan->save();
            return redirect()->back()->with('notif_berhasil', 'Data jenis layanan berhasil dirubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisLayanan  $jenisLayanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $jenisLayanan)
    {
        try {
            if ($request->get('jenis_hapus') == 'all') {
                $id = $request->input('txtIdHapusTerpilih');
                $arrId = explode(',', $id);
                foreach ($arrId as $key => $value) {
                    $layanan = JenisLayanan::find($value);
                    $layanan->status_hapus = 1;
                    $layanan->save();
                }
                return redirect()->back()->with(['notif_berhasil'=>'Data Layanan Berhasil Dihapus.']);
            } else {
                $layanan = JenisLayanan::find($jenisLayanan);
                $layanan->status_hapus = 1;
                $layanan->save();
                return redirect()->back()->with(['notif_berhasil'=>'Data Layanan Berhasil Dihapus.']);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('danger_message','Data Layanan Gagal Dihapus');
        }
    }
}
