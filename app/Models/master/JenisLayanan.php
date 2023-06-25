<?php

namespace App\Models\master;

use App\Models\master\Obat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisLayanan extends Model
{
    use HasFactory;
    protected $table = 'layanan';

    public function obat(){
        return $this->belongsToMany(Obat::class,'obat_layanan','id_layanan','id_obat')->withPivot('qty','subtotal');
    }
    
    public function validator(array $data, $desire)
    {
        if($desire=='tambah')
        {
            return Validator::make($data, [
                'txtNamaLayanan' => 'required|string|max:100',
                'txtTarifLayanan' => 'required|between:0,99.99',
            ]);
        }
        elseif ($desire=='edit') 
        {
            // return Validator::make($data, [
            //     'txtNamaEdit' => 'required|string|max:100',
            //     'txtBBLEdit' => 'required|between:0,99.99',
            //     'cbxCaraPersalinanEdit' => 'required|string|max:20',
            //     'txtNamaAyahEdit' => 'required',
            //     'txtNamaIbuEdit' => 'required',
            //     'txtAlamatEdit' => 'required|string|max:255',
            //     'txtTelpEdit' => 'required',
            //     'txtTTLEdit' => 'required',
            // ]);
        }
        
    }
}
