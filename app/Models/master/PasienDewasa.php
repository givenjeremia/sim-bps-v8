<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Model;
use App\Models\master\SuamiPasienDewasa;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasienDewasa extends Model
{
    use HasFactory;
    public function suamiPasienDewasa(){
        return $this->hasMany(SuamiPasienDewasa::class, 'id_pasien_dewasa','id');
        
    }
}
