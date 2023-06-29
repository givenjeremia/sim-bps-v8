<?php

namespace App\Models\master;

use App\Models\layanan\Kb;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\master\SuamiPasienDewasa;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PasienDewasa extends Model
{
    use HasFactory;
    protected $table = 'pasien_dewasa';
    protected $primaryKey = 'no_regis';
    protected $keyType = 'string';
    public $incrementing = false;

    public static function generateNoRegister()
    {
        $current_time = str_replace('-', '',Carbon::now()->toDateString());
        $get = static::where('no_regis', 'LIKE', 'PD'.$current_time.'%')->max(DB::raw('CAST(SUBSTRING(no_regis, -3) AS UNSIGNED)')) + 1;
        // $no_nota_generator_penjualan = 
        return 'PD'.$current_time.str_pad($get, 3, "0", STR_PAD_LEFT);
    }


    public function suamiPasienDewasa(){
        return $this->hasMany(SuamiPasienDewasa::class, 'no_regis_pasien_dewasa','no_regis');
        
    }

    public function kb(){
        return $this->hasMany(Kb::class, 'no_regis_pasien_dewasa','no_regis');
        
    }

}
