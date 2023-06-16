<?php

namespace App\Models\master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaPuskesmas extends Model
{
    use HasFactory;
    protected $table = 'kepala_puskesmas';
    public $timestamps = false;
}
