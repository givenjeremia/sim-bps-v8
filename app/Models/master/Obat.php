<?php

namespace App\Models\master;

use App\Models\HistoryIbuHamilObat;
use App\Models\master\JenisLayanan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Obat extends Model
{
    use HasFactory;
    protected $table = 'obat';

    public function layanan(){
        return $this->belongsToMany(JenisLayanan::class,'obat_layanan','id_obat','id_layanan')->withPivot('qty','subtotal');
    }

    public function klinik(){
        return $this->belongsToMany(JenisLayanan::class,'klinik_obat','id_obat','id_layanan')->withPivot('qty','subtotal','total_harga_obat');
    }

    public function kb(){
        return $this->belongsToMany(JenisLayanan::class,'kb_obat','id_obat','id_history_kb')->withPivot('qty','subtotal','total_harga_obat');
    }

    // public function ibuHamil(){
    //     return $this->belongsToMany(HistoryIbuHamilObat::class,'kb_obat','id_obat','id_history_kb')->withPivot('qty','subtotal','total_harga_obat');
    // }



}
