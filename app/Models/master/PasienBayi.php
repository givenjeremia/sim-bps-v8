<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class PasienBayi extends Model
{
    use HasFactory;
    protected $table = 'pasien_bayi';
    
    protected function validator(array $data, $desire)
    {
        if($desire=='tambah')
        {
            return Validator::make($data, [
                'txtNama' => 'required|string|max:100',
                'txtBBL' => 'required|between:0,99.99',
                'cbxCaraPersalinan' => 'required|string|max:20',
                'txtNamaAyah' => 'required',
                'txtNamaIbu' => 'required',
                'txtAlamat' => 'required|string|max:255',
                'txtTelp' => 'required',
                'dtpTanggalLahir' => 'required',
            ]);
        }
        elseif ($desire=='edit') 
        {
            return Validator::make($data, [
                'txtNamaEdit' => 'required|string|max:100',
                'txtBBLEdit' => 'required|between:0,99.99',
                'cbxCaraPersalinanEdit' => 'required|string|max:20',
                'txtNamaAyahEdit' => 'required',
                'txtNamaIbuEdit' => 'required',
                'txtAlamatEdit' => 'required|string|max:255',
                'txtTelpEdit' => 'required',
                'txtTTLEdit' => 'required',
            ]);
        }
        
    }
}
