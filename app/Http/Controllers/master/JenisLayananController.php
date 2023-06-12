<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\master\Obat;
use Illuminate\Http\Request;
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
        $layanan = JenisLayanan::where('status_hapus','=',0)->orderBy('id', 'desc')->get();
        return view('master\jenisLayanan', compact('layanan'));
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
        $tarif_layanan = (double)str_replace(',', '', $request->input('txtTarifLayanan'));
        $total_layanan = 0;

        $created_by = Auth::user()->id;
        $created_at = Carbon::now();
        $updated_by = Auth::user()->id;
        $updated_at = Carbon::now();

        $validation = new JenisLayanan();
        $validation = $validation->validator($request->all(), 'tambah');
        if ($validation->fails())  
        {
            return redirect()->back()->with(['notif_gagal'=>'Data jenis layanan gagal disimpan.']);
        }
        else
        {
            $new = new JenisLayanan();
            $new->pelayanan = $pelayanan;
            $new->nama = $nama_layanan;
            $new->tarif_layanan = $tarif_layanan;
            $new->tarif_total = $total_layanan;
            $new->status_hapus = 0;
            $new->created_at = $created_at;
            $new->created_by = $created_by;
            $new->updated_at = $updated_at;
            $new->updated_by = $updated_by;
            $new->save();
            $id_new = $new->id;
            $arrIdObat = explode(',', $id_obat);
            $arrQty = explode(',', $qty);
            if($id_obat!="")
            {
                foreach ($arrIdObat as $key => $value) {
                    // $obat = DB::table('obat')->where('id', '=', $value)->get();
                    $obat = Obat::find($value);
                    $obat->id_obat

                    DB::table('obat_layanan')->insert(
                        [
                        'id_obat' => $value,
                        'id_layanan' => $layanan[0]->id,
                        'qty' => $arrQty[$key],
                        'subtotal' => $obat[0]->harga*$arrQty[$key]
                        ]
                        );
                }

                $layanan_baru = DB::table('layanan')->where('status_hapus', '=', 0)->orderBy('id', 'desc')->get();
                $total_tarif_layanan = DB::select('SELECT DISTINCT l.id, l.nama, (sum(ol.subtotal)+l.tarif_layanan) as total_layanan FROM layanan as l, obat_layanan as ol, obat as o WHERE l.id = ol.id_layanan AND ol.id_obat = o.id AND l.status_hapus = 0 AND l.id = '.$layanan_baru[0]->id.' GROUP BY l.id, l.nama, l.tarif_layanan');
                DB::table('layanan')
                ->where('id', $layanan_baru[0]->id)
                ->update([
                    'tarif_total' => $total_tarif_layanan[0]->total_layanan,
                    'updated_at' => Carbon::now(),
                    'updated_by' => Auth::user()->id
                ]);

                return redirect()->back()->with('notif_berhasil', 'Data jenis layanan berhasil ditambahkan');
            }
            else
            {
                $layanan_baru = DB::table('layanan')->where('status_hapus', '=', 0)->orderBy('id', 'desc')->get();
                DB::table('layanan')
                ->where('id', $layanan_baru[0]->id)
                ->update([
                    'tarif_total' => $layanan_baru[0]->tarif_layanan,
                    'updated_at' => Carbon::now(),
                    'updated_by' => Auth::user()->id
                ]);

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
    public function show(JenisLayanan $jenisLayanan)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisLayanan  $jenisLayanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisLayanan $jenisLayanan)
    {
        //
    }
}
