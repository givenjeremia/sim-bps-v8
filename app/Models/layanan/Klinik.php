<?php

namespace App\Models\layanan;

use App\Models\master\Obat;
use App\Models\master\JenisLayanan;
use App\Models\master\PasienDewasa;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Klinik extends Model
{
    use HasFactory;
    protected $table ='layanan_klinik';

    public function layanan(){
        return $this->belongsTo(JenisLayanan::class,'layanan_id');
    }
    public function pasien_dewasa(){
        return $this->belongsTo(PasienDewasa::class,'no_regis_pasien_dewasa');
    }

    public function obat_layanan(){
        return $this->belongsToMany(Obat::class,'klinik_obat','id_layanan','id_obat')->withPivot('qty','harga_obat','total_harga_obat');
    }

    public function transaksi(){
        return $this->hasMany(Transaksi::class,'id_layanan','id');
    }

}
