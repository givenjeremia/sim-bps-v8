<?php

namespace App\Http\Controllers;

use App\Models\master\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PengingatObatController extends Controller
{
    public function indexExpired()
    {
        $obat = Obat::where('status_hapus',0)->whereBetween('tanggal_kadaluarsa', [date("Y-m-d"),date('Y-m-d', strtotime(date("Y-m-d"). ' +10 day'))])->get();
        return view('pengingat.obat.expired', compact('obat')); 
    }

    public function indexStok()
    {
        $obat = Obat::where('status_hapus',0)->where('total_pcs','<','10')->get();
        return view('pengingat.obat.stok', compact('obat')); 
    }

    public function hitungPengingat()
    {
        $expired = DB::select("SELECT * FROM obat o WHERE o.status_hapus=0 AND (o.tanggal_kadaluarsa BETWEEN '".date("Y-m-d")."' AND '".date('Y-m-d', strtotime(date("Y-m-d"). ' +10 day'))."')");
        $stok = DB::select("SELECT * FROM obat o WHERE o.status_hapus=0 AND o.total_pcs<10");

        echo json_encode(array('expired' => $expired, 'stok' => $stok));
    }
    
    public function hapus_data(Request $request)
    {
        //
        obat::where('id', $request->idHapus)->update(
            [
                'status_hapus' => 1,
                'updated_by' => Auth::user()->id
            ]);
        return redirect()->back()->with(['message'=>'Data Obat berhasil dihapus.']);
    }
    public function delete_all_data(Request $request)
    {
        //
        obat::whereIn('id', $request->txtDeleteAll)->update(
            [
                'status_hapus' => 1,
                'updated_by' => Auth::user()->id
            ]);
        return redirect()->back()->with(['message'=>'Data Obat berhasil dihapus.']);
    }
    public function update_data(Request $request)
    {
        //
        obat::where('id', $request->idUpdate)->update(
            [
                'nama' => $request->txtNamaEdit,
                'kode_obat' => $request->txtKodeEdit, 
                'merk' => $request->txtMerkEdit, 
                'catatan' => $request->txtCttnEdit, 
                'tanggal_kadaluarsa' => date("Y-m-d", strtotime($request->tglkadaluarsaEdit)), 
                'updated_by' => Auth::user()->id
            ]);
        return redirect()->back()->with(['message'=>'Data Obat berhasil diganti.']);
    }
    public function update_harga(Request $request)
    {
        //
        $obatnya = obat::find($request->idUpdate);
        $harganya = (int)str_replace(',', '', $request->txtHargaEdit);
        $harga = $harganya/$obatnya['pcs'];
        //echo $obatnya['pcs'];
        obat::where('id', $request->idUpdate)->update(
            [
                'harga' => $harga,
                'updated_by' => Auth::user()->id
            ]);
        return redirect()->back()->with(['message'=>'Harga Obat berhasil diganti.']);
    }
    public function tambah_stok(Request $request)
    {
        //

        $obatnya = obat::find($request->idUpdate);
        $stok_saat_ini = $obatnya['total_pcs'];
        $stok_update = $stok_saat_ini + ($request->txtSatuanJmlTambah == 0 ? $request->txtJmlTambah : $request->txtJmlTambah*$obatnya['pcs']);
        //echo $obatnya['pcs'];
        obat::where('id', $request->idUpdate)->update(
            [
                'total_pcs' => $stok_update,
                'updated_by' => Auth::user()->id
            ]);
        return redirect()->back()->with(['message'=>'Stok Obat berhasil ditambah.']);
    }
    public function kurang_stok(Request $request)
    {
        //

        $obatnya = obat::find($request->idUpdate);
        $stok_saat_ini = $obatnya['total_pcs'];
        $stok_update = $stok_saat_ini - ($request->txtSatuanJmlKurang == 0 ? $request->txtJmlKurang : $request->txtJmlKurang*$obatnya['pcs']);
        //echo $obatnya['pcs'];
        obat::where('id', $request->idUpdate)->update(
            [
                'total_pcs' => $stok_update,
                'updated_by' => Auth::user()->id
            ]);
        return redirect()->back()->with(['message'=>'Stok Obat berhasil dikurangi.']);
    }
}
