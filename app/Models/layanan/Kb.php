<?php

namespace App\Models\layanan;

use App\Models\master\JenisLayanan;
use App\Models\master\PasienDewasa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kb extends Model
{
    use HasFactory;
    protected $table ='layanan_kb';

    public function pasienDewasa()
    {
        return $this->belongsTo(PasienDewasa::class,'no_regis_pasien_dewasa');
    }

    public function layanan(){
        return $this->belongsTo(JenisLayanan::class,'id_jenis_layanan');
    }

}
